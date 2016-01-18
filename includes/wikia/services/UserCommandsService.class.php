<?php

	class UserCommandsService {
		
		protected $cache = [];
		
		public function clearCache() {
			$this->cache = [];
		}

		/**
		 * @param string $name Command ID
		 * @param array $options (optional)
		 * @return UserCommand
		 */
		public function get( $name, $options = [] ) {
			$hash = $name . ( $options ? serialize( $options ) : '' );
			if ( empty( $this->cache[$hash] ) ) {
				list( $type, $data ) = explode( ':', $name, 2 );
                                
				$className = false;
				switch ( $type ) {
					case 'SpecialPage':
						$className = 'SpecialPageUserCommand';
						break;
					case 'PageAction':
						if ( in_array( $data, ['Share','Follow' ] ) ) {
							$className = "{$data}UserCommand";
						} else {
							$className = 'PageActionUserCommand';
						}
						break;
					case 'Action':
						if ( in_array( $data, ['CustomizeToolbar', 'DevInfo', 'Shortcuts'] ) ) {
							$className = "{$data}UserCommand";
						}
						break;
				}

				$this->cache[$hash] = $className ? new $className( $name, $options ) : null;
			}
			return $this->cache[$hash];
		}
		
		public function createMenu( $id, $caption, $options = [] ) {
			return new MenuUserCommand( $id, $caption, $options );
		}
		
	}
	
$wgAutoloadClasses['UserCommand'] = dirname(__FILE__) . '/usercommands/UserCommand.php';
$wgAutoloadClasses['PageActionUserCommand'] = dirname(__FILE__) . '/usercommands/PageActionUserCommand.php';
$wgAutoloadClasses['FollowUserCommand'] = dirname(__FILE__) . '/usercommands/FollowUserCommand.php';
$wgAutoloadClasses['SpecialPageUserCommand'] = dirname(__FILE__) . '/usercommands/SpecialPageUserCommand.php';
$wgAutoloadClasses['CustomizeToolbarUserCommand'] = dirname(__FILE__) . '/usercommands/CustomizeToolbarUserCommand.php';
$wgAutoloadClasses['MenuUserCommand'] = dirname(__FILE__) . '/usercommands/MenuUserCommand.php';
// Developer Info a.k.a. PerformanceStats (BugId:5497)
$wgAutoloadClasses['DevInfoUserCommand'] = dirname( __FILE__ ) . '/usercommands/DevInfoUserCommand.php';
$wgAutoloadClasses['ShortcutsUserCommand'] = dirname( __FILE__ ) . '/usercommands/ShortcutsUserCommand.php';
