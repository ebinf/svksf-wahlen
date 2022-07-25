<?php

namespace Ebinf\SVKSFWahlen\Model;

use Pagekit\Application as App;
use Pagekit\System\Model\DataModelTrait;
use Pagekit\Database\ORM\ModelTrait;

/**
 * @Entity(tableClass="@svksf_wahlen_candidatures")
 */
class Candidature implements \JsonSerializable {
	use ModelTrait;

	/** @Column(type="integer") @Id */
	public $id;

  /** @Column(type="string") */
	public $name = '';

  /** @Column(type="string") */
	public $email = '';

  /** @Column(type="string") */
	public $class = '';

  /** @Column(type="boolean") */
	public $is_class_rep = false;

  /** @Column(type="string") */
	public $office = '';

  /** @Column(type="boolean") */
	public $deputy = false;

	/** @Column(type="integer") */
	public $status = 0;

	/** @Column(type="text") */
	public $message = '';

	/** @Column(type="datetime") */
	public $date;

	/** @Column(type="text") */
	public $rejection_reason = '';

	/** @Column(type="datetime") */
	public $rejection_date;

	/**
	 * Constructor.
	 */
	public function __construct () {
		$this->date = new \DateTime;
	}

	/**
	 * {@inheritdoc}
	 */
	public function jsonSerialize () {
		return $this->toArray();
	}

}
