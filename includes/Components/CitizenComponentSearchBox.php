<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Citizen\Components;

use MessageLocalizer;
use Skin;

/**
 * CitizenComponentSearchBox component
 */
class CitizenComponentSearchBox implements CitizenComponent {
	/** @var MessageLocalizer */
	private $localizer;

	/** @var array */
	private $searchBoxData;

	/** @var Skin */
	private $skin;

	/**
	 * @param MessageLocalizer $localizer
	 * @param array $searchBoxData
	 */
	public function __construct(
		MessageLocalizer $localizer,
		array $searchBoxData,
		Skin $skin
	) {
		$this->localizer = $localizer;
		$this->searchBoxData = $searchBoxData;
		$this->skin = $skin;
	}

	/**
	 * Get the keyboard hint data
	 * @return array
	 */
	private function getKeyboardHintData() {
		$data = [];
		// There is probably a cleaner way to handle this
		$map = [
			'↑ ↓' => $this->localizer->msg( "citizen-search-keyhint-select" )->text(),
			'/' => $this->localizer->msg( "citizen-search-keyhint-open" )->text(),
			'Esc' => $this->localizer->msg( "citizen-search-keyhint-exit" )->text()
		];

		foreach ( $map as $key => $label ) {
			$keyhint = new CitizenComponentKeyboardHint( $label, $key );
			$data[] = $keyhint->getTemplateData();
		}
		return $data;
	}

	/**
	 * @inheritDoc
	 */
	public function getTemplateData(): array {
		$searchBoxData = $this->searchBoxData;

		return $searchBoxData += [
			'array-keyboard-hint' => $this->getKeyboardHintData(),
			'msg-citizen-search-footer' => $this->localizer->msg( "citizen-search-footer" )->text(),
			'msg-citizen-search-toggle-shortcut' => '[/]',
			'html-random-href' => $this->skin->makeSpecialUrl( 'Randompage' ),
		];
	}
}
