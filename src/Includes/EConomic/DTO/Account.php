<?php

namespace MIQID\Plugin\WooCommerce\Includes\EConomic\DTO;

use MIQID\Plugin\WooCommerce\Util;

class Account extends Base {
	/** @var int|null */
	private $accountNumber;
	/** @var string|null */
	private $accountType;
	/** @var float|null */
	private $balance;
	/** @var float|null */
	private $draftBalance;
	/** @var bool */
	private $barred;
	/** @var bool */
	private $blockDirectEntries;
	/** @var Account|null */
	private $contraAccount;
	/** @var string|null */
	private $debitCredit;
	/** @var string|null */
	private $name;
	/** @var array|null */
	private $vatAccount;
	/** @var array|null */
	private $accountsSummed;
	/** @var Account|null */
	private $totalFromAccount;
	/** @var string|null */
	private $accountingYears;
	/** @var string|null */
	private $self;

	public function __construct( ?array $Account = null ) {
		if ( is_array( $Account ) ) {
			$this->parse_array( $Account );
		}
	}

	/**
	 * @param int|null $accountNumber
	 */
	public function set_account_number( ?int $accountNumber ): void {
		$this->accountNumber = $accountNumber;
	}

	/**
	 * @return int|null
	 */
	public function get_account_number(): ?int {
		return $this->accountNumber;
	}

	/**
	 * @param string|null $accountType
	 */
	public function set_account_type( ?string $accountType ): void {
		$this->accountType = $accountType;
	}

	/**
	 * @return string|null
	 */
	public function get_account_type(): ?string {
		return $this->accountType;
	}

	/**
	 * @param float|null $balance
	 */
	public function set_balance( ?float $balance ): void {
		$this->balance = $balance;
	}

	/**
	 * @return float|null
	 */
	public function get_balance(): ?float {
		return $this->balance;
	}

	/**
	 * @param float|null $draftBalance
	 */
	public function set_draft_balance( ?float $draftBalance ): void {
		$this->draftBalance = $draftBalance;
	}

	/**
	 * @return float|null
	 */
	public function get_draft_balance(): ?float {
		return $this->draftBalance;
	}

	/**
	 * @param bool|int|string|null $barred
	 */
	public function set_barred( $barred ): void {
		if ( ! is_null( $barred ) ) {
			$barred = filter_var( $barred, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->barred = $barred;
	}

	/**
	 * @return bool
	 */
	public function is_barred(): bool {
		return $this->barred ?? false;
	}

	/**
	 * @param bool|int|string|null $blockDirectEntries
	 */
	public function set_block_direct_entries( $blockDirectEntries ): void {
		if ( ! is_null( $blockDirectEntries ) ) {
			$blockDirectEntries = filter_var( $blockDirectEntries, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		}
		$this->blockDirectEntries = $blockDirectEntries;
	}

	/**
	 * @return bool
	 */
	public function is_block_direct_entries(): bool {
		return $this->blockDirectEntries ?? false;
	}

	/**
	 * @param array|Account|null $contraAccount
	 */
	public function set_contra_account( $contraAccount ): void {
		if ( is_array( $contraAccount ) ) {
			$contraAccount = new Account( $contraAccount );
		}
		$this->contraAccount = $contraAccount;
	}

	/**
	 * @return Account|null
	 */
	public function get_contra_account(): ?Account {
		return $this->contraAccount ?? new Account();
	}

	/**
	 * @param string|null $debitCredit
	 */
	public function set_debit_credit( ?string $debitCredit ): void {
		$this->debitCredit = $debitCredit;
	}

	/**
	 * @return string|null
	 */
	public function get_debit_credit(): ?string {
		return $this->debitCredit;
	}

	/**
	 * @param array|null $vatAccount
	 */
	public function set_vat_account( ?array $vatAccount ): void {
		$this->vatAccount = $vatAccount;
	}

	/**
	 * @return array|null
	 */
	public function get_vat_account(): ?array {
		return $this->vatAccount;
	}

	/**
	 * @param array|null $accountsSummed
	 */
	public function set_accounts_summed( ?array $accountsSummed ): void {
		$this->accountsSummed = $accountsSummed;
	}

	/**
	 * @return array|null
	 */
	public function get_accounts_summed(): ?array {
		return $this->accountsSummed;
	}

	/**
	 * @param array|Account|null $totalFromAccount
	 */
	public function set_total_from_account( $totalFromAccount ): void {
		if ( is_array( $totalFromAccount ) ) {
			$totalFromAccount = new Account( $totalFromAccount );
		}
		$this->totalFromAccount = $totalFromAccount;
	}

	/**
	 * @return Account|null
	 */
	public function get_total_from_account(): Account {
		return $this->totalFromAccount ?? new Account();
	}

	/**
	 * @param string|null $accountingYears
	 */
	public function set_accounting_years( ?string $accountingYears ): void {
		$this->accountingYears = $accountingYears;
	}

	/**
	 * @return string|null
	 */
	public function get_accounting_years(): ?string {
		return $this->accountingYears;
	}

	public function jsonSerialize(): array {
		$vars = get_object_vars( $this );
		$vars = Util::filter_null_from( $vars );

		return $vars;
	}
}