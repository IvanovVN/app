/*global define*/
define('ext.wikia.adEngine.lookup.prebid.prebidHelper', [
	'ext.wikia.adEngine.lookup.prebid.adaptersRegistry',
	'wikia.window'
], function(
	adaptersRegistry,
	win
) {
	'use strict';
	var adUnits = [],
		lazyLoad = 'off',
		lazyLoadSlots = [
			'BOTTOM_LEADERBOARD'
		];

	function getAdapterAdUnits(adapter, skin) {
		var adapterAdUnits = [],
			slots = adapter.getSlots(skin);

		Object.keys(slots).forEach(function(slotName) {
			var prepareAdUnit = adapter.prepareAdUnit,
				adUnit = prepareAdUnit(slotName, slots[slotName], skin);

			if (adUnit) {
				adapterAdUnits.push(adUnit);
			}
		});

		return adapterAdUnits;
	}

	function addAdUnits(adapterAdUnits) {
		adapterAdUnits.forEach(function (adUnit) {
			var isSlotLazy = lazyLoadSlots.indexOf(adUnit.code) !== -1;

			if (lazyLoad === 'off' || (lazyLoad === 'pre' && !isSlotLazy) || (lazyLoad === 'post' && isSlotLazy)) {
				adUnits.push(adUnit);
			}
		});
	}

	function setupAdUnits(skin, mode) {
		var adapters = adaptersRegistry.getAdapters();

		lazyLoad = mode || lazyLoad;
		adUnits = [];
		adapters.forEach(function (adapter) {
			if (adapter && adapter.isEnabled()) {
				addAdUnits(getAdapterAdUnits(adapter, skin));
			}
		});

		return adUnits;
	}

	return {
		setupAdUnits: setupAdUnits
	};
});
