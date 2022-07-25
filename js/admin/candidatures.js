$().ready(function () {
  new Vue({
      el: '#svksf-wahlen-candidatures',
      data() {
          return _.merge({
              selected: [],
              candidatures: false
          }, window.$data);
      },
      created() {
          this.Candidatures = this.$resource('api/svksf/wahlen/candidatures');
          this.load();
      },
      methods: {
        load() {
            return this.Candidatures.query().then(res => {
                this.$set('candidatures', Object.values(res.data));
            });
        },

        getSelected() {
            return this.candidatures.filter(candidature => String(candidature.id) in this.selected);
        },

        markSigned(candidature) {
          var res = this.$resource('api/svksf/wahlen/candidatures{/id}');
          if (candidature.status === 0 || candidature.status === 1) {
            res.save({id: candidature.id}, {candidature: candidature}).then(() => {
              this.load();
              this.$notify('Als unterschrieben markiert.');
            });
          }
        },

        markSelectedSigned() {
          console.log("Running!", this.selected, this.getSelected());
          for (var candidature in this.getSelected()) {
            console.log(this.candidatures[candidature].name);
          }
        }
      },
      components: {
          candidature: {
              props: ['candidature'],
              template: '#candidature',
              filters: {
                humanDateTime(input) {
                  var dt = new Date(input);
                  return dt.toLocaleString("de", {day: "2-digit", month: "2-digit", year: "numeric", hour: "2-digit", minute: "2-digit"});
                }
              },
              methods: {
                getStatusString(status) {
                  switch (status) {
                    case 0:
                      return "Neu eingegangen";
                      break;
                    case 1:
                      return "Ausgedruckt";
                      break;
                    case 2:
                      return "Unterschrieben";
                      break;
                    case 3:
                      return "Zurückgezogen";
                      break;
                    case 4:
                      return "Abgelehnt";
                      break;
                    default:
                      return "Unbekannt";
                  }
                },
                getDeputyOffice(candidature) {
                  if (candidature.deputy) return `stellv. ${candidature.office}`;
                  return candidature.office;
                }
              }
          }
      },
  });
});
