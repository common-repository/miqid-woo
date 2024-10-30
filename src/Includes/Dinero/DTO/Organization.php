<?php


namespace MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;

use MIQID\Plugin\WooCommerce\{Includes\Dinero\DTO};

class Organization extends DTO {
	/** @var string|null */
	private $Name;
	/** @var int|null */
	private $Id;
	/** @var string|null */
	private $Type;
	/** @var bool */
	private $IsPro;
	/** @var bool */
	private $IsPayingPro;
	/** @var bool */
	private $IsVatFree;
	/** @var string|null */
	private $Email;
	/** @var bool */
	private $IsTaxFreeUnion;
	/** @var string|null */
	private $VatNumber;

	public function __construct(
		$Name = null,
		$Id = null,
		$Type = null,
		$IsPro = null,
		$IsPayingPro = null,
		$IsVatFree = null,
		$Email = null,
		$IsTaxFreeUnion = null,
		$VatNumber = null
	) {
		if ( is_array( $Name ) ) {
			$this->parse_array( $Name );
		}

		if ( isset( $Name ) ) {
			$this->set_name( $Name );
		}
		if ( isset( $Id ) ) {
			$this->set_id( $Id );
		}
		if ( isset( $Type ) ) {
			$this->set_type( $Type );
		}
		if ( isset( $IsPro ) ) {
			$this->set_is_pro( $IsPro );
		}
		if ( isset( $IsPayingPro ) ) {
			$this->set_is_paying_pro( $IsPayingPro );
		}
		if ( isset( $IsVatFree ) ) {
			$this->set_is_vat_free( $IsVatFree );
		}
		if ( isset( $Email ) ) {
			$this->set_email( $Email );
		}
		if ( isset( $IsTaxFreeUnion ) ) {
			$this->set_is_tax_free_union( $IsTaxFreeUnion );
		}
		if ( isset( $VatNumber ) ) {
			$this->set_vat_number( $VatNumber );
		}
	}

	/**
	 * @param string|null $Name
	 */
	public function set_name( ?string $Name ): void {
		$this->Name = $Name;
	}

	/**
	 * @param int|null $Id
	 */
	public function set_id( ?int $Id ): void {
		$this->Id = $Id;
	}

	/**
	 * @param string|null $Type
	 */
	public function set_type( ?string $Type ): void {
		$this->Type = $Type;
	}

	/**
	 * @param bool $IsPro
	 */
	public function set_is_pro( bool $IsPro ): void {
		$this->IsPro = $IsPro;
	}

	/**
	 * @param bool $IsPayingPro
	 */
	public function set_is_paying_pro( bool $IsPayingPro ): void {
		$this->IsPayingPro = $IsPayingPro;
	}

	/**
	 * @param bool $IsVatFree
	 */
	public function set_is_vat_free( bool $IsVatFree ): void {
		$this->IsVatFree = $IsVatFree;
	}

	/**
	 * @param string|null $Email
	 */
	public function set_email( ?string $Email ): void {
		$this->Email = $Email;
	}

	/**
	 * @param bool $IsTaxFreeUnion
	 */
	public function set_is_tax_free_union( bool $IsTaxFreeUnion ): void {
		$this->IsTaxFreeUnion = $IsTaxFreeUnion;
	}

	/**
	 * @param string|null $VatNumber
	 */
	public function set_vat_number( ?string $VatNumber ): void {
		$this->VatNumber = $VatNumber;
	}


	/**
	 * @return string|null
	 */
	public function get_name(): ?string {
		return $this->Name;
	}

	/**
	 * @return int|null
	 */
	public function get_id(): ?int {
		return $this->Id;
	}

	/**
	 * @return string|null
	 */
	public function get_type(): ?string {
		return $this->Type;
	}

	/**
	 * @return bool
	 */
	public function is_is_pro(): bool {
		return $this->IsPro ?? false;
	}

	/**
	 * @return bool
	 */
	public function is_is_paying_pro(): bool {
		return $this->IsPayingPro ?? false;
	}

	/**
	 * @return bool
	 */
	public function is_is_vat_free(): bool {
		return $this->IsVatFree ?? false;
	}

	/**
	 * @return string|null
	 */
	public function get_email(): ?string {
		return $this->Email;
	}

	/**
	 * @return bool
	 */
	public function is_is_tax_free_union(): bool {
		return $this->IsTaxFreeUnion ?? false;
	}

	/**
	 * @return string|null
	 */
	public function get_vat_number(): ?string {
		return $this->VatNumber;
	}

	public function jsonSerialize() {
		$vars = get_object_vars( $this );

		return $vars;
	}
}