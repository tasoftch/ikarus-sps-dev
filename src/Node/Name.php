<?php


namespace Ikarus\SPS\Dev\Node;


class Name
{
	/** @var string */
	private $name;

	/**
	 * Name constructor.
	 * @param string $name
	 */
	public function __construct(string $name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}