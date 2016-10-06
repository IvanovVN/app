define(
	'wikia.flowTracking.createPage',
	['wikia.flowTracking', 'wikia.querystring', 'mw', 'wikia.document', 'wikia.window'],
	function (flowTrack, QueryString, mw, document, window) {
		'use strict';
		
		var namespaceId = mw.config.get('wgNamespaceNumber'),
			articleId = mw.config.get('wgArticleId');

		function trackOnEditPageLoad(editor) {
			// Track only creating articles (wgArticleId=0) from namespace 0 (Main)
			// IMPORTANT: on Special:CreatePage even after providing article title the namespace is set to -1 (Special Page)
			if (namespaceId === 0 && articleId === 0) {
				var qs = new QueryString(),
				// 'flow' is the parameter passed in the url if user has started a flow already
					flowParam = qs.getVal('flow', false);

				if (flowParam || document.referrer) {
					//TODO: track middle step for other flows
				} else {
					flowTrack.beginFlow(flowTrack.flows.CREATE_PAGE_DIRECT_URL, {editor: editor});
					qs.setVal('flow', flowTrack.flows.CREATE_PAGE_DIRECT_URL);
					window.history.replaceState({}, '', qs.toString());
				}
			}
		}

		return {
			trackOnEditPageLoad: trackOnEditPageLoad
		}
	}
);
