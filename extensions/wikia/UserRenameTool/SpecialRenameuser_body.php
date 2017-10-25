<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	echo "RenameUser extension\n";
	exit( 1 );
}

/**
 * Special page allows authorised users to rename
 * user accounts
 */
class SpecialRenameuser extends SpecialPage {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct( 'UserRenameTool', 'renameuser', true );
	}

	/**
	 * Show the special page
	 *
	 * @param mixed $par Parameter passed to the page
	 *
	 * @throws PermissionsError
	 * @throws ReadOnlyError
	 */
	public function execute( $par ) {
		global $wgStatsDBEnabled;

		$this->setHeaders();
		$this->checkPermissions();

		$out = $this->getOutput();
		$this->addJSFiles();

		if ( wfReadOnly() || !$wgStatsDBEnabled ) {
			$out->readOnlyPage();
			return;
		}

		// Get the request data
		$request = $this->getRequest();
		$oldUsername = $this->getUser()->getName();
		$newUsername = $request->getText( 'newusername' );
		$reason = $request->getText( 'reason' );
		$token = $this->getUser()->getEditToken();
		$confirmAction = false;

		if ( $request->wasPosted() && $request->getInt( 'confirmaction' ) ) {
			$confirmAction = true;
		}

		$warnings = [];
		$errors = [];
		$info = [];

		if ( $this->validRenameRequest( $request ) ) {
			$process = new RenameUserProcess( $this->getUser()->getName(), $newUsername, $confirmAction, $reason );
			$status = $process->run();
			$warnings = $process->getWarnings();
			$errors = $process->getErrors();
			if ( $status ) {
				$info[] = $this->msg( 'userrenametool-info-in-progress' )->inContentLanguage()->escaped();
			}
		}

		$showConfirm = ( empty( $errors ) && empty( $info ) );

		// note: errors and info beyond this point are non-blocking

		if ( $this->getUser()->getGlobalFlag( 'wasRenamed', 0 ) ) {
			$errors[] = $this->msg( 'userrenametool-error-alreadyrenamed' );
		}

		$template = new EasyTemplate( __DIR__ . '/templates/' );
		$template->set_vars(
			[
				"submitUrl"     	=> $this->getTitle()->getLocalURL(),
				"oldusername"   	=> $oldUsername,
				"oldusername_hsc"	=> htmlspecialchars( $oldUsername ),
				"newusername"   	=> $newUsername,
				"newusername_hsc"	=> htmlspecialchars( $newUsername ),
				"reason"        	=> $reason,
				"move_allowed"  	=> $this->getUser()->isAllowed( 'move' ),
				"confirmaction" 	=> $confirmAction,
				"warnings"      	=> $warnings,
				"errors"        	=> $errors,
				"infos"         	=> $info,
				"show_confirm"  	=> $showConfirm,
				"token"         	=> $token
			]
		);

		$text = $template->render( "rename-form" );
		$out->addHTML( $text );

		return;
	}

	private function validRenameRequest( WebRequest $request ) {
		if ( !$request->wasPosted() ) {
			return false;
		}

		$token = $request->getText( 'token' );
		if ( $token === '' ) {
			return false;
		}

		if ( !$this->isUsernameRepeatedCorrectly( $request ) ) {
			return false;
		}

		return $this->getUser()->matchEditToken( $token );
	}

	private function isUsernameRepeatedCorrectly( WebRequest $request ): bool {
		return $request->getText( 'newusername' ) === $request->getText( 'newusernamerepeat' );
	}

	private function addJSFiles() {
		$this->getOutput()->addScript( Html::linkedScript( AssetsManager::getInstance()
			->getOneCommonURL( '/extensions/wikia/UserRenameTool/js/NewUsernameUrlEncoder.js' ) ) );
	}
}
