<?php

/**
 * Helper functions for Admin Dashboard
 */

class AdminDashboardLogic {

	public static function isGeneralApp($appName) {
		$generalApps = array(
			'Categories' => true,
			'CreateBlogPage' => true,
			'CreatePage' => true,
			'Listusers' => true,
			'ListUsers' => true,
			'MultipleUpload' => true,
			'PageLayoutBuilder' => true,
			'Recentchanges' => true,
			'RecentChanges' => true,
			'ThemeDesigner' => true,
			'Upload' => true,
			'UserRights' => true,
			'Userrights' => true,
			'WikiFeatures' => true,
		);
		return !empty($generalApps[$appName]);
	}

	/**
	 * @brief Helper function which determines whether to display the Admin Dashboard Chrome in the Oasis Skin
	 * @param type $title Title of page we are on
	 * @return type boolean
	 */
	public static function displayAdminDashboard($app, $title) {
		// Admin Dashboard is only for logged in plus a list of groups
		if (!$app->wg->User->isLoggedIn()) return false;
		if (!$app->wg->User->isAllowed( 'admindashboard' )) return false;
		if ($title && $title->isSpecialPage()) {
			$bits = explode( '/', $title->getDBkey(), 2 );
			$alias = SpecialPage::resolveAlias($bits[0]);

			// NOTE: keep this list in alphabetical order
			static $exclusionList = array(
				"AdSS",
				"ApiExplorer",
				"ApiGate",
				"Chat",
				"Code",
				"Confirmemail",
				"Connect",
				"Contact",
				"ContentWarning",
				"Contributions",
				"CreateBlogPage",
				"CreatePage",
				"CreateNewWiki",
				"CreateTopList",
				"Crunchyroll",
				"CloseWiki",
				"EditAccount",
				"EditTopList",
				"Following",
				"Forum",
				"HuluVideoPanel",
				"ImageReview",
				"Invalidateemail",
				"LandingPageSmurfs",
				"LayoutBuilder",
				"LayoutBuilderForm",
				"Leaderboard",
				"LookupContribs",
				"LookupUser",
				"MiniEditor",
				"MovePage",
				"MultiLookup",
				"NewFiles",
				"Newimages",
				"Our404Handler",
				"PageLayoutBuilder",
				"PageLayoutBuilderForm",
				"Phalanx",
				"PhalanxStats",
				"PhotoPopSetup",
				"Places",
				"Preferences",
				"RecentChanges",
				"ScavengerHunt",
				"Search",
				"WikiaSearch",
				"Signup",
				"SiteWideMessages",
				"SponsorshipDashboard",
				"TaskManager",
				"ThemeDesigner",
				"ThemeDesignerPreview",
				"UserLogin",
				"UserSignup",
				"UserPathPrediction",
				"Version",
				"WhereIsExtension",
				"WikiActivity",
				"WikiaLogin",
				"WikiFactory",
				"WikiFactoryReporter",
				"WikiStats",
				"UserManagement",
			);
			return (!in_array($alias, $exclusionList));
		}
		return false;
	}
	
	/**
	 *  @brief hook to add toolbar item for admin dashboard
	 *  
	 */
	function onBeforeToolbarMenu(&$items) {
		if( F::app()->wg->User->isAllowed('admindashboard') ) {
			$item = array(
				'type' => 'html',
				'html' => Wikia::specialPageLink('AdminDashboard', 'admindashboard-toolbar-link', array('data-tracking' => 'admindashboard/toolbar/admin') )
			);
			
			if( is_array($items) ) {
				$isMenuSubElPresent = false;
				
				foreach($items as $el) {
					if( isset($el['type']) && $el['type'] === 'menu' ) {
						$isMenuSubElPresent = true;
						break;
					}
				}
				
				if( $isMenuSubElPresent ) {
					$items[] = $item;
				}
			} else {
				$items = array($item);
			}
		}
		return true;
	}
}
