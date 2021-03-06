<?php
/**
 * Class definition for \Wikia\Search\IndexService\MediaData
 *
 * @author relwell
 */
namespace Wikia\Search\IndexService;
/**
 * Returns additional data about images and videos
 *
 * @author relwell
 * @package Search
 * @subpackage IndexService
 */
class MediaData extends AbstractService {
	/**
	 * Extracts data from images and videos
	 *
	 * @see \Wikia\Search\IndexService\AbstractService::execute()
	 * @return array
	 */
	public function execute() {
		$results = [];
		$service = $this->getService();
		if ( !( $service->getNamespaceFromPageId( $this->currentPageId ) == NS_FILE &&
			$service->pageIdHasFile( $this->currentPageId ) )
		) {
			return $results;
		}

		$detail = $service->getMediaDetailFromPageId( $this->currentPageId );
		$metadata = $service->getMediaDataFromPageId( $this->currentPageId );

		$results['is_video'] = $service->pageIdIsVideoFile( $this->currentPageId ) ? 'true' : 'false';
		$results['is_image'] =
			( ( $detail['mediaType'] == 'image' ) && $results['is_video'] == 'false' ) ? 'true' : 'false';

		if ( !empty( $metadata ) ) {
			$metadata = unserialize( $metadata );
			$fileParams = [ 'description', 'keywords' ];
			if ( $results['is_video'] ) {
				$fileParams =
					array_merge( $fileParams, [ 'movieTitleAndYear', 'videoTitle', 'title', 'tags', 'category' ] );

				/**
				 * This maps video metadata field keys to dynamic fields
				 */
				$videoMetadataMapper = [
					'provider' => 'video_provider_s',
					'videoId' => 'video_id_s',
					'aspectRatio' => 'video_aspectratio_s'
				];

				foreach ( $videoMetadataMapper as $key => $field ) {
					if ( isset( $metadata[$key] ) ) {
						$results[$field] = $metadata[$key];
					}
				}
				// special cases
				if ( isset( $metadata['duration'] ) ) {
					$results['video_duration_i'] = (int) $metadata['duration'];
				}

				if ( isset( $metadata['keywords'] ) ) {
					$results['video_keywords_txt'] = explode( ', ', $metadata['keywords'] );
				}
				if ( isset( $metadata['tags'] ) ) {
					$results['video_tags_txt'] = explode( ', ', str_replace( '-', ' ', $metadata['tags'] ) );
				}
				if ( isset( $metadata['description'] ) ) {
					$results['video_description_txt'] = $metadata['description'];
				}
			}

			$results['html_media_extras_txt'] = [];
			foreach ( $fileParams as $datum ) {
				if ( isset( $metadata[$datum] ) ) {
					$results['html_media_extras_txt'][] = $metadata[$datum];
				}
			}
		}

		return $results;
	}

}
