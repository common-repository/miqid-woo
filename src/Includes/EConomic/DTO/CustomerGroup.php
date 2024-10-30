<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class CustomerGroup extends Base {
	/** @var int|null */
	private $customerGroupNumber;
	/** @var string|null */
	private $name;
	/** @var Account|null */
	private $account;
	/** @var string|null */
	private $customers;
	/** @var Layout|null */
	private $layout;
	/** @var string|null */
	private $self;

	public function __construct(
		$customerGroupNumber = null,
		$name = null,
		$account = null,
		$customers = null,
		$layout = null,
		$self = null
	) {
		if ( is_array( $customerGroupNumber ) ) {
			$this->parse_array( $customerGroupNumber );
		}
		if ( isset( $customerGroupNumber ) ) {
			$this->set_customer_group_number( $customerGroupNumber );
		}
		if ( isset( $name ) ) {
			$this->set_name( $name );
		}
		if ( isset( $account ) ) {
			$this->set_account( $account );
		}
		if ( isset( $customers ) ) {
			$this->set_customers( $customers );
		}
		if ( isset( $layout ) ) {
			$this->set_layout( $layout );
		}
		if ( isset( $self ) ) {
			$this->set_self( $self );
		}
	}

	/**
	 * @param int|null $customerGroupNumber
	 *
	 * @return CustomerGroup
	 */
	public function set_customer_group_number( ?int $customerGroupNumber ): CustomerGroup {
		$this->customerGroupNumber = $customerGroupNumber;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_customer_group_number(): ?int {
		return $this->customerGroupNumber;
	}

	/**
	 * @param array|Account|null $account
	 *
	 * @return CustomerGroup
	 */
	public function set_account( $account ): CustomerGroup {
		if ( is_array( $account ) ) {
			$account = new Account( $account );
		}
		$this->account = $account;

		return $this;
	}

	/**
	 * @return Account
	 */
	public function get_account(): Account {
		return $this->account ?? new Account();
	}

	/**
	 * @param string|null $customers
	 *
	 * @return CustomerGroup
	 */
	public function set_customers( ?string $customers ): CustomerGroup {
		$this->customers = $customers;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function get_customers(): ?string {
		return $this->customers;
	}

	/**
	 * @param array|Layout|null $layout
	 *
	 * @return CustomerGroup
	 */
	public function set_layout( $layout ): CustomerGroup {
		if ( is_array( $layout ) ) {
			$layout = new Layout( $layout );
		}
		$this->layout = $layout;

		return $this;
	}

	/**
	 * @return Layout
	 */
	public function get_layout(): Layout {
		return $this->layout ?? new Layout();
	}

	public function jsonSerialize(): array {
		$arr = get_object_vars( $this );
		$arr = Util::filter_null_from( $arr );

		return $arr;
	}
}