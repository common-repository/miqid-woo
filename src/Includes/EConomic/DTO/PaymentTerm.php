<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class PaymentTerm extends Base {
	/** @var int|null */
	private $paymentTermsNumber;
	/** @var int|null */
	private $daysOfCredit;
	/** @var string|null */
	private $description;
	/** @var string */
	private $paymentTermsType;
	/** @var Account */
	private $contraAccountForPrepaidAmount;
	/** @var Account */
	private $contraAccountForRemainderAmount;
	/** @var float|null */
	private $percentageForPrepaidAmount;
	/** @var float|null */
	private $percentageForRemainderAmount;
	/** @var array */
	private $creditCardCompany;

	public function __construct( ?array $PaymentTerm = null ) {
		if ( is_array( $PaymentTerm ) ) {
			$this->parse_array( $PaymentTerm );
		}
	}

	/**
	 * @param int|null $paymentTermsNumber
	 *
	 * @return PaymentTerm
	 */
	public function set_payment_terms_number( ?int $paymentTermsNumber ): self {
		$this->paymentTermsNumber = $paymentTermsNumber;

		return $this;
	}

	/**
	 * @param int|null $daysOfCredit
	 *
	 * @return PaymentTerm
	 */
	public function set_days_of_credit( ?int $daysOfCredit ): self {
		$this->daysOfCredit = $daysOfCredit;

		return $this;
	}

	/**
	 * @param string|null $description
	 *
	 * @return PaymentTerm
	 */
	public function set_description( ?string $description ): self {
		$this->description = $description;

		return $this;
	}

	/**
	 * @param string|null $paymentTermsType
	 *
	 * @return PaymentTerm
	 */
	public function set_payment_terms_type( ?string $paymentTermsType ): self {
		$this->paymentTermsType = $paymentTermsType;

		return $this;
	}

	/**
	 * @param Account|null $contraAccountForPrepaidAmount
	 *
	 * @return PaymentTerm
	 */
	public function set_contra_account_for_prepaid_amount( ?Account $contraAccountForPrepaidAmount ): self {
		$this->contraAccountForPrepaidAmount = $contraAccountForPrepaidAmount;

		return $this;
	}

	/**
	 * @param Account|null $contraAccountForRemainderAmount
	 *
	 * @return PaymentTerm
	 */
	public function set_contra_account_for_remainder_amount( ?Account $contraAccountForRemainderAmount ): self {
		$this->contraAccountForRemainderAmount = $contraAccountForRemainderAmount;

		return $this;
	}

	/**
	 * @param float|null $percentageForPrepaidAmount
	 *
	 * @return PaymentTerm
	 */
	public function set_percentage_for_prepaid_amount( ?float $percentageForPrepaidAmount ): self {
		$this->percentageForPrepaidAmount = $percentageForPrepaidAmount;

		return $this;
	}

	/**
	 * @param float|null $percentageForRemainderAmount
	 *
	 * @return PaymentTerm
	 */
	public function set_percentage_for_remainder_amount( ?float $percentageForRemainderAmount ): self {
		$this->percentageForRemainderAmount = $percentageForRemainderAmount;

		return $this;
	}

	/**
	 * @param array|null $creditCardCompany
	 *
	 * @return PaymentTerm
	 */
	public function set_credit_card_company( ?array $creditCardCompany ): self {
		$this->creditCardCompany = $creditCardCompany;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function get_payment_terms_number(): ?int {
		return $this->paymentTermsNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_days_of_credit(): ?int {
		return $this->daysOfCredit;
	}

	/**
	 * @return string|null
	 */
	public function get_description(): ?string {
		return $this->description;
	}

	/**
	 * @return string|null
	 */
	public function get_payment_terms_type(): ?string {
		return $this->paymentTermsType;
	}

	/**
	 * @return float|null
	 */
	public function get_percentage_for_prepaid_amount(): ?float {
		return $this->percentageForPrepaidAmount;
	}

	/**
	 * @return float|null
	 */
	public function get_percentage_for_remainder_amount(): ?float {
		return $this->percentageForRemainderAmount;
	}

	/**
	 * @return array|null
	 */
	public function get_credit_card_company(): ?array {
		return $this->creditCardCompany;
	}

	/**
	 * @return Account
	 */
	public function get_contra_account_for_prepaid_amount(): Account {
		return $this->contraAccountForPrepaidAmount ?? new Account();
	}

	/**
	 * @return Account
	 */
	public function get_contra_account_for_remainder_amount(): Account {
		return $this->contraAccountForRemainderAmount ?? new Account();
	}

	public function jsonSerialize(): array {
		$arr         = get_object_vars( $this );
		$arr['name'] = $this->get_name();
		//$arr['self'] = $this->get_self();
		$arr = Util::filter_null_from( $arr );

		return $arr;
	}
}