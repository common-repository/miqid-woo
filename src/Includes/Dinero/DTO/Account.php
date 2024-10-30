<?php

namespace MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;

use MIQID\Plugin\WooCommerce\Includes\Dinero\DTO;

class Account extends DTO {
	/** @var int|null */
	private $AccountNumber;
	/** @var string|null */
	private $Name;
	/** @var string|null */
	private $VatCode;
	/** @var string|null */
	private $Category;
	/** @var bool */
	private $IsHidden;
	/** @var bool */
	private $IsDefaultSalesAccount;

	public function __construct(
		$AccountNumber = null,
		$Name = null,
		$VatCode = null,
		$Category = null,
		$IsHidden = null,
		$IsDefaultSalesAccount = null
	) {
		if ( is_array( $AccountNumber ) ) {
			$this->parse_array( $AccountNumber );
		}

		if ( isset( $AccountNumber ) ) {
			$this->set_account_number( $AccountNumber );
		}
		if ( isset( $Name ) ) {
			$this->set_name( $Name );
		}
		if ( isset( $VatCode ) ) {
			$this->set_vat_code( $VatCode );
		}
		if ( isset( $Category ) ) {
			$this->set_category( $Category );
		}
		if ( isset( $IsHidden ) ) {
			$this->set_is_hidden( $IsHidden );
		}
		if ( isset( $IsDefaultSalesAccount ) ) {
			$this->set_is_default_sales_account( $IsDefaultSalesAccount );
		}
	}

	/**
	 * @param int|null $AccountNumber
	 *
	 * @return Account
	 */
	public function set_account_number( ?int $AccountNumber ): Account {
		$this->AccountNumber = $AccountNumber;

		return $this;
	}

	/**
	 * @param string|null $Name
	 *
	 * @return Account
	 */
	public function set_name( ?string $Name ): Account {
		$this->Name = $Name;

		return $this;
	}

	/**
	 * @param string|null $VatCode
	 *
	 * @return Account
	 */
	public function set_vat_code( ?string $VatCode ): Account {
		$this->VatCode = $VatCode;

		return $this;
	}

	/**
	 * @param string|null $Category
	 *
	 * @return Account
	 */
	public function set_category( ?string $Category ): Account {
		$this->Category = $Category;

		return $this;
	}

	/**
	 * @param bool $IsHidden
	 *
	 * @return Account
	 */
	public function set_is_hidden( bool $IsHidden ): Account {
		$this->IsHidden = $IsHidden;

		return $this;
	}

	/**
	 * @param bool $IsDefaultSalesAccount
	 *
	 * @return Account
	 */
	public function set_is_default_sales_account( bool $IsDefaultSalesAccount ): Account {
		$this->IsDefaultSalesAccount = $IsDefaultSalesAccount;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_account_number(): ?int {
		return $this->AccountNumber;
	}

	/**
	 * @return string|null
	 */
	public function get_name(): ?string {
		return $this->Name;
	}

	/**
	 * @return string|null
	 */
	public function get_vat_code(): ?string {
		return $this->VatCode;
	}

	/**
	 * @return string|null
	 */
	public function get_category(): ?string {
		return $this->Category;
	}

	/**
	 * @return bool
	 */
	public function is_hidden(): bool {
		return $this->IsHidden;
	}

	/**
	 * @return bool
	 */
	public function is_default_sales_account(): bool {
		return $this->IsDefaultSalesAccount;
	}

	public function jsonSerialize() {
		$vars = get_object_vars( $this );

		return $vars;
	}
}