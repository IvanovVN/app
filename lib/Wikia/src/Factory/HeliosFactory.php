<?php
namespace Wikia\Factory;

use function Wikia\CircuitBreaker\CircuitBreakerFactory;
use Wikia\Service\Helios\HeliosClient;
use Wikia\Service\User\Auth\AuthService;
use Wikia\Service\User\Auth\CookieHelper;
use Wikia\Util\Statistics\BernoulliTrial;

class HeliosFactory extends AbstractFactory {

        const AUTH_SERVICE_NAME = 'helios';

	/** @var HeliosClient $heliosClient */
	private $heliosClient;

	/** @var CookieHelper $cookieHelper */
	private $cookieHelper;

	/** @var AuthService $authService */
	private $authService;

	/**
	 * @param HeliosClient $heliosClient
	 */
	public function setHeliosClient( HeliosClient $heliosClient ) {
		$this->heliosClient = $heliosClient;
	}

	public function heliosClient(): HeliosClient {
		if ( $this->heliosClient === null ) {
			global $wgAuthServiceInternalUrl, $wgTheSchwartzSecretToken;

			$urlProviderFactory = $this->serviceFactory()->providerFactory();
			$urlProvider = $urlProviderFactory->urlProvider();

			$heliosUrl = $wgAuthServiceInternalUrl ?: "http://{$urlProvider->getUrl( self::AUTH_SERVICE_NAME )}/";
			$circuitBreaker = CircuitBreakerFactory( new BernoulliTrial( 0.01 ) );

			$this->heliosClient = new HeliosClient( $heliosUrl, $wgTheSchwartzSecretToken, $circuitBreaker );
		}

		return $this->heliosClient;
	}

	public function cookieHelper(): CookieHelper {
		if ( $this->cookieHelper === null ) {
			$this->cookieHelper = new CookieHelper( $this->heliosClient() );
		}

		return $this->cookieHelper;
	}

	public function authService(): AuthService {
		if ( $this->authService === null ) {
			$this->authService = new AuthService( $this->heliosClient() );
		}

		return $this->authService;
	}
}
