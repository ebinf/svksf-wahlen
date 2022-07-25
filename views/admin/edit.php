<?php $view->script('candidature-edit', 'wahlen:js/admin/edit.js', ['vue', 'uikit-nestable']) ?>

<div id="svksf-wahlen-edit" class="uk-form uk-form-horizontal" v-cloak>
  <form class="uk-form" @submit.prevent="save">
    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
      <div data-uk-margin v-if="editable">
        <h2 v-if="candidature.id">Kandidatur bearbeiten</h2>
        <h2 v-else>Kandidatur hinzufügen</h2>
      </div>
      <div data-uk-margin v-else>
        <h2>Kandidatur ansehen</h2>
      </div>
      <div data-uk-margin v-if="editable">
        <a class="uk-button uk-margin-small-right" :href="$url.route('admin/svksf/wahlen/candidatures')">Abbrechen</a>
        <button class="uk-button uk-button-primary" type="submit">Speichern</button>
      </div>
      <div data-uk-margin v-else>
        <a class="uk-button" :href="$url.route('admin/svksf/wahlen/candidatures')">Zurück</a>
      </div>
    </div>
    <pre>{{ candidature |json }}</pre>
    <div class="uk-form uk-form-horizontal">
      <h3>Angaben zur Person</h3>
      <div class="uk-form-row">
        <label for="candidature-name" class="uk-form-label">Name</label>
        <div class="uk-form-controls">
          <input id="candidature-name" class="uk-form-width-large" type="text" v-model="candidature.name" :disabled="!editable">
        </div>
      </div>
      <div class="uk-form-row">
        <label for="candidature-email" class="uk-form-label">E-Mail</label>
        <div class="uk-form-controls">
          <input id="candidature-email" class="uk-form-width-large" type="text" v-model="candidature.email" :disabled="!editable" v-validate:email>
        </div>
      </div>
      <div class="uk-form-row">
        <label for="candidature-class" class="uk-form-label">Klasse</label>
        <div class="uk-form-controls">
          <input id="candidature-class" style="width: 5rem;" type="text" maxlength="5" v-model="candidature.class" :disabled="!editable">
        </div>
      </div>
      <div class="uk-form-row">
        <span class="uk-form-label">Amt in Klasse/Tutorium</span>
        <div class="uk-form-controls uk-form-controls-text">
          <label><input type="checkbox" v-model="candidature.is_class_rep" :disabled="!editable"> (stellv.) Klassensprecher*in/Tutoriumssprecher*in</label>
        </div>
      </div>
      <hr />
      <h3>Kandidatur</h3>
      <div class="uk-form-row">
        <label for="candidature-office" class="uk-form-label">Amt</label>
        <div class="uk-form-controls">
          <p class="uk-form-controls-condensed">
            <input id="candidature-office" class="uk-form-width-large" type="text" v-model="candidature.office" :disabled="!editable">
          </p>
          <p class="uk-form-controls-condensed">
            <label><input type="checkbox" v-model="candidature.deputy" :disabled="!editable"> nur Stellvertreter*in</label>
          </p>
        </div>
      </div>
      <div class="uk-form-row">
        <span class="uk-form-label">Status</span>
        <div class="uk-form-controls uk-form-controls-text">
          <p class="uk-form-controls-condensed">
            <label><input type="radio" :value="0" v-model="candidature.status" :disabled="!editable"> Neu eingegangen</label>
          </p>
          <p class="uk-form-controls-condensed">
            <label><input type="radio" :value="1" v-model="candidature.status" :disabled="!editable"> Ausgedruckt</label>
          </p>
          <p class="uk-form-controls-condensed">
            <label><input type="radio" :value="2" v-model="candidature.status" :disabled="!editable"> Unterschrieben</label>
          </p>
          <p class="uk-form-controls-condensed">
            <label><input type="radio" :value="3" v-model="candidature.status" :disabled="!editable"> Zurückgezogen</label>
          </p>
          <p class="uk-form-controls-condensed">
            <label><input type="radio" :value="4" v-model="candidature.status" :disabled="!editable"> Abgelehnt</label>
          </p>
        </div>
      </div>
      <div class="uk-form-row">
        <label for="candidature-class" class="uk-form-label">Anmerkungen/Fragen</label>
        <div class="uk-form-controls">
          <textarea class="uk-form-width-large" rows="2" v-model="candidature.message" :disabled="!editable"></textarea>
        </div>
      </div>
      <div class="uk-form-row">
        <label for="candidature-class" class="uk-form-label">Kandidatur abgesendet</label>
        <div class="uk-form-controls uk-form-controls-text">{{ candidature.date|humanDateTime }}</div>
      </div>
      <div v-if="candidature.status === 4">
        <hr />
        <h3>Ablehnung</h3>
        <div class="uk-form-row">
          <label for="candidature-class" class="uk-form-label">Grund der Ablehnung</label>
          <div class="uk-form-controls">
            <input class="uk-form-width-large" type="text" list="rejectionReasons" v-model="candidature.rejection_reason" :disabled="!editable">
            <datalist id="rejectionReasons">
              <option>Schüler*in ist kein*e (stellv.) Klassensprecher*in.</option>
              <option>Schüler*in geht nicht in die angegebene Klasse.</option>
              <option>Schüler*in besucht den falschen Jahrgang.</option>
              <option>Schüler*in kann keine Wählbarkeitsbescheinigung vorlegen.</option>
              <option>Der Wahlvorstand hat sich mit Mehrheit gegen die Kandidatur entscheiden.</option>
            </datalist>
          </div>
        </div>
        <div class="uk-form-row">
          <label for="candidature-class" class="uk-form-label">Abgelehnt am</label>
          <div class="uk-form-controls uk-form-controls-text">{{ candidature.rejection_date|humanDateTime }}</div>
        </div>
      </div>
    </div>
  </form>
</div>
