<?php

class MediaToolItem extends WikiaObject {
	const THUMB_WIDTH = 96;
	const THUMB_HEIGHT = 72;
	const THUMB_BIG_WIDTH = 600;

	/**
	 * @var bool
	 */
	protected $isVideo = true;
	/**
	 * @var Title
	 */
	protected $title = null;
	protected $titleText = null;
	/**
	 * @var string
	 */
	protected $hash;
	protected $thumbUrl = null;
	protected $thumbHtml = null;
	protected $remoteUrl;
	protected $duration;
	/**
	 * @var User
	 */
	protected $uploader = false;
	private $file = null;

	public function __construct(Title $title = null) {
		if( $title !== null ) {
			$this->setTitle($title);
		}
	}

	public function setDuration($duration) {
		$this->duration = $duration;
	}

	public function getDuration() {
		return $this->duration;
	}

	/**
	 * @param string $hash
	 */
	public function setHash($hash) {
		$this->hash = $hash;
	}

	/**
	 * @return string
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * @param bool $isVideo
	 */
	public function setIsVideo($isVideo) {
		$this->isVideo = $isVideo;
	}

	/**
	 * @return bool
	 */
	public function isVideo() {
		return $this->isVideo;
	}

	public function setRemoteUrl($remoteUrl) {
		$this->remoteUrl = $remoteUrl;
	}

	public function getRemoteUrl() {
		return $this->remoteUrl;
	}

	public function setThumbUrl($thumbUrl) {
		$this->thumbUrl = $thumbUrl;
	}

	public function getThumbUrl() {
		if($this->thumbUrl === null) {
			if( $this->hasFile() ) {
				$thumbObj = $this->getFile()->transform( array( 'width' => self::THUMB_BIG_WIDTH ) );
				$this->thumbUrl = $thumbObj->getUrl();
			}
			else {
				$this->thumbUrl = '';
			}
		}
		return $this->thumbUrl;
	}

	/**
	 * @param Title $title
	 */
	public function setTitle(Title $title) {
		$this->title = $title;
		$this->setHash(md5($title->getFullText()));
		if($this->hasFile()) {
			$this->setIsVideo( WikiaFileHelper::isFileTypeVideo( $this->getFile() ) );
		}
	}

	public function setTitleText($titleText) {
		$this->titleText = $titleText;
		$this->setHash(md5($titleText));
	}

	/**
	 * @return Title
	 */
	public function getTitle() {
		if($this->title instanceof Title) {
			return $this->title;
		}
		else {
			throw new WikiaException('MediaToolItem::getTitle() called when title is null');
		}
	}

	public function getFile() {
		if( empty( $this->file ) ) {
			$this->file = wfFindFile( $this->getTitle() );
		}
		return $this->file;
	}

	public function hasFile() {
		return (bool) $this->getFile();
	}

	/**
	 * get user who uploaded this item
	 * @return User|null
	 */
	public function getUploader() {
		if($this->uploader === false) {
			if($this->hasFile()) {
				$userId = $this->getFile()->getUser('id');
				if(!empty($userId)) {
					$this->uploader = F::build('User', array( 'id' => $userId ), 'newFromId');
				}
				else {
					$this->uploader = null;
				}
			}
			else {
				$this->uploader = null;
			}
		}
		return $this->uploader;
	}

	public function hasUploader() {
		return (bool) $this->getUploader();
	}

	public function setUploader(User $uploader) {
		$this->uploader = $uploader;
	}

	public function getThumbHtml($reload = false) {
		if(($this->thumbHtml === null) || $reload) {
			$file = $this->getFile();

			if( $file ) {
				$thumbObj = $file->transform( array( 'width' => self::THUMB_WIDTH, 'height' => self::THUMB_HEIGHT ) );
				$this->thumbHtml = $thumbObj->toHtml(
					array(
						'custom-url-link' => '',
						'linkAttribs' => array(
							'class' => '',
							'data-ref' => $this->getTitle()->getPrefixedDbKey()
						),
						'duration' => true,
						'src' => false,
						'constHeight' => self::THUMB_HEIGHT,
						'usePreloading' => false
					)
				);
			}
			else {
				$this->thumbHtml = '';
			}
		}
		return $this->thumbHtml;
	}

	public function setThumbHtml($thumbHtml) {
		$this->thumbHtml = $thumbHtml;
	}

	public function toArray() {
		$array = array(
			'isVideo' => $this->isVideo(),
			'hash' => $this->getHash(),
			'title' => is_null($this->titleText) ? $this->getTitle()->getPrefixedDBkey() : $this->titleText,
			'thumbHtml' => $this->getThumbHtml(),
			'thumbUrl' => $this->getThumbUrl(),
			'remoteUrl' => $this->getRemoteUrl(),
			'duration' => $this->getDuration(),
		);

		if( $this->hasUploader() ) {
			$array['uploaderId'] = $this->getUploader()->getId();
			$array['uploaderName'] = $this->getUploader()->getName();
			$array['uploaderPage'] = $this->getUploader()->getUserPage()->getFullUrl();
			$array['uploaderAvatar'] = AvatarService::getAvatarUrl($this->getUploader());
		}
		else {
			$array['uploaderId'] = 0;
		}

		return $array;
	}
}