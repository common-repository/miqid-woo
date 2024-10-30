<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class objSelf extends Base {
	/** @var int|null */
	private $agreementNumber;
	/** @var array|null */
	private $agreementType;
	/** @var string|null */
	private $userName;
	/** @var \DateTime|null */
	private $signupDate;

	public function __construct(
		$agreementNumber = null,
		$agreementType = null,
		$userName = null,
		$signupDate = null,
		$name = null,
		$self = null
	) {
		parent::__construct( $name, $self );

		if ( is_array( $agreementNumber ) ) {
			$this->parse_array( $agreementNumber );
		}

		$this->set_agreement_number( $agreementNumber );
		$this->set_agreement_type( $agreementType );
		$this->set_user_name( $userName );
		$this->set_signup_date( $signupDate );
	}

	/**
	 * @param int|null $agreementNumber
	 */
	public function set_agreement_number( ?int $agreementNumber ): void {
		$this->agreementNumber = $agreementNumber ?? $this->agreementNumber;
	}

	/**
	 * @param array|null $agreementType
	 */
	public function set_agreement_type( ?array $agreementType ): void {
		$this->agreementType = $agreementType ?? $this->agreementType;
	}

	/**
	 * @param string|null $userName
	 */
	public function set_user_name( ?string $userName ): void {
		$this->userName = $userName ?? $this->userName;
	}

	/**
	 * @param \DateTime|string|null $signupDate
	 */
	public function set_signup_date( $signupDate ): void {
		if ( is_string( $signupDate ) ) {
			$signupDate = date_create( $signupDate );
		}
		$this->signupDate = $signupDate ?? $this->signupDate;
	}

	/**
	 * @return int|null
	 */
	public function get_agreement_number(): ?int {
		return $this->agreementNumber;
	}

	/**
	 * @return array|null
	 */
	public function get_agreement_type(): ?array {
		return $this->agreementType;
	}

	/**
	 * @return string|null
	 */
	public function get_user_name(): ?string {
		return $this->userName;
	}

	/**
	 * @return \DateTime|string|null
	 */
	public function get_signup_date( $format = null ) {
		if ( $this->signupDate instanceof \DateTime && ! empty( $format ) ) {
			return $this->signupDate->format( $format );
		}

		return $this->signupDate;
	}

	public function jsonSerialize() {
		$vars         = get_object_vars( $this );
		$vars['name'] = $this->get_name();
		$vars['self'] = $this->get_self();
		$vars         = Util::filter_null_from( $vars );

		return $vars;
	}
}