$().ready(function () {
  new Vue({
      el: '#svksf-wahlen-edit',
      data() {
          return window.$data;
      },
      ready() {
        this.Candidature = this.$resource("api/svksf/wahlen/candidature{/id}");
      },
      filters: {
        humanDateTime(input) {
          if (!input) return '–';
          var dt = new Date(input);
          return dt.toLocaleString("de", {day: "2-digit", month: "2-digit", year: "numeric", hour: "2-digit", minute: "2-digit", second: "2-digit", weekday: "long"});
        }
      },
      methods: {
        save() {
          this.Candidature.save({id: this.id}, {candidature: this.candidature}).then(function (res) {
            data = res.data;
            if (!this.candidature.id) {
                window.history.replaceState({}, '', this.$url.route('admin/svksf/wahlen/candidatures/edit/{id}', {id: data.candidature.id}));
            }
            this.$set('candidature', data.candidature);
            this.$notify("Kandidatur gespeichert!");
          }, function (err) {
            this.$notify(`Fehler! ${err.statusText}`, "danger");
          });
        }
      }
  });
});
