<?php $view->script('candidatures', 'wahlen:js/admin/candidatures.js', ['vue', 'uikit-nestable']) ?>

<div id="svksf-wahlen-candidatures" class="uk-form uk-form-horizontal" v-cloak>

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

			<h2 class="uk-margin-remove">Kandidaturen</h2>

      <div class="uk-margin-left" v-show="selected.length">
				<ul class="uk-subnav pk-subnav-icon">
					<li>
						<a class="pk-icon-share pk-icon-hover" title="Drucken"
						   data-uk-tooltip="{delay: 500}" @click="console.log('test')"
						   v-confirm="'Alle markierten Kandidaturen drucken und als ausgedruckt markieren?'"></a>
					</li>
          <li>
						<a class="pk-icon-check pk-icon-hover" title="Als unterschrieben markieren"
						   data-uk-tooltip="{delay: 500}" @click.prevent="markSelectedSigned"
						   v-confirm="'Alle markierten Kandidaturen als unterschrieben markieren?'"></a>
					</li>
				</ul>
			</div>

		</div>
    <div class="uk-position-relative" data-uk-margin>

			<div data-uk-dropdown="{ mode: 'click' }" v-if="canEdit">
				<a class="uk-button uk-button-primary" :href="$url.route('admin/svksf/wahlen/candidatures/add')">
					Kandidatur hinzufügen</a>
			</div>

		</div>
	</div>

	<div class="uk-overflow-container">

		<div class="pk-table-fake pk-table-fake-header" :class="{'pk-table-fake-border': !candidatures || !candidatures.length}">
			<div class="pk-table-width-minimum pk-table-fake-nestable-padding">
				<input type="checkbox" v-check-all:selected.literal="input[name=id]"></div>
			<div class="pk-table-min-width-200">Name</div>
			<div class="pk-table-width-100">Klasse</div>
			<div class="pk-table-width-200">Amt</div>
			<div class="pk-table-width-100 uk-text-center">Status</div>
			<div class="pk-table-width-150">Datum</div>
		</div>

		<ul class="uk-nestable uk-margin-remove" v-el:nestable v-show="candidatures.length">
			<candidature v-for="candidature in candidatures" :candidature="candidature"></candidature>

		</ul>

	</div>

	<h3 class="uk-h1 uk-text-muted uk-text-center" v-show="candidatures && !candidatures.length">Keine Kandidaturen gefunden.</h3>

</div>

<script id="candidature" type="text/template">
	<li class="uk-nestable-item" :data-id="candidature.id">
		<div class="uk-nestable-panel pk-table-fake uk-form uk-visible-hover">
			<div class="pk-table-width-minimum pk-table-collapse">
				<div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
			</div>
			<div class="pk-table-width-minimum"><input type="checkbox" name="id" value="{{ candidature.id }}"></div>
			<div class="pk-table-min-width-100">
				<a :href="$url.route('admin/svksf/wahlen/candidatures/edit/{id}', { id: candidature.id })">{{ candidature.name }}</a>
			</div>
      <div class="pk-table-width-100">
				{{ candidature.class }}
			</div>
      <div class="pk-table-width-200">
				{{ getDeputyOffice(candidature) }}
			</div>
			<div class="pk-table-width-100 uk-text-center">
				<td class="uk-text-center">
          <!-- Candidature statuses:
                0: New
                1: Printed
                2: Signed
								3: Withdrawn
								4: Rejected
          -->
					<span :class="{
            'pk-icon-circle-info': candidature.status === 0,
            'pk-icon-circle-primary': candidature.status === 1,
            'pk-icon-circle-success': candidature.status === 2,
						'pk-icon-circle-warning': candidature.status === 3,
            'pk-icon-circle-danger': candidature.status === 4
          }" data-uk-tooltip="{delay: 500}" :title="getStatusString(candidature.status)"></span>
				</td>
			</div>
      <div class="pk-table-width-150">
				{{ candidature.date | humanDateTime }}
			</div>
		</div>


	</li>

</script>
