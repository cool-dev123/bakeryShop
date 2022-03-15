<template>
  <v-data-table
      :headers="headers"
      :items="weekdays"
      class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
          flat
      >
        <v-spacer></v-spacer>
        <v-dialog
            v-model="dialog"
            max-width="500px"
        >
          <v-card>
            <v-card-title>
              <span class="text-h5">Change Times</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                      cols="12"
                      sm="6"
                      md="4"
                  >
                    <v-menu
                      ref="open_time_menu"
                      v-model="open_time_menu"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      :return-value.sync="editedItem.open_time"
                      transition="scale-transition"
                      offset-y
                      max-width="290px"
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="editedItem.open_time"
                          label="Open Time:"
                          prepend-icon="mdi-clock-time-four-outline"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-time-picker
                        v-if="open_time_menu"
                        v-model="editedItem.open_time"
                        :max="editedItem.close_time"
                        full-width
                        @click:minute="$refs.open_time_menu.save(editedItem.open_time)"
                      ></v-time-picker>
                    </v-menu>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="6"
                      md="4"
                  >
                    <v-menu
                      ref="close_time_menu"
                      v-model="close_time_menu"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      :return-value.sync="editedItem.close_time"
                      transition="scale-transition"
                      offset-y
                      max-width="290px"
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="editedItem.close_time"
                          label="Close Time:"
                          prepend-icon="mdi-clock-time-four-outline"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-time-picker
                        v-if="close_time_menu"
                        v-model="editedItem.close_time"
                        :min="editedItem.open_time"
                        full-width
                        @click:minute="$refs.close_time_menu.save(editedItem.close_time)"
                      ></v-time-picker>
                    </v-menu>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col
                      cols="12"
                      sm="6"
                      md="4"
                  >
                    <v-menu
                      ref="lanch_time_start_menu"
                      v-model="lanch_time_start_menu"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      :return-value.sync="editedItem.lanch_time_start"
                      transition="scale-transition"
                      offset-y
                      max-width="290px"
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="editedItem.lanch_time_start"
                          label="Lanch Time Start:"
                          prepend-icon="mdi-clock-time-four-outline"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-time-picker
                        v-if="lanch_time_start_menu"
                        v-model="editedItem.lanch_time_start"
                        :max="editedItem.lanch_time_end"
                        full-width
                        @click:minute="$refs.lanch_time_start_menu.save(editedItem.lanch_time_start)"
                      ></v-time-picker>
                    </v-menu>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="6"
                      md="4"
                  >
                    <v-menu
                      ref="lanch_time_end_menu"
                      v-model="lanch_time_end_menu"
                      :close-on-content-click="false"
                      :nudge-right="40"
                      :return-value.sync="editedItem.lanch_time_end"
                      transition="scale-transition"
                      offset-y
                      max-width="290px"
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="editedItem.lanch_time_end"
                          label="Lanch Time End:"
                          prepend-icon="mdi-clock-time-four-outline"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-time-picker
                        v-if="lanch_time_end_menu"
                        v-model="editedItem.lanch_time_end"
                        :min="editedItem.lanch_time_start"
                        full-width
                        @click:minute="$refs.lanch_time_end_menu.save(editedItem.lanch_time_end)"
                      ></v-time-picker>
                    </v-menu>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                  color="blue darken-1"
                  text
                  @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                  color="blue darken-1"
                  text
                  @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
    </template>
  </v-data-table>
</template>

<script>
export default {
  name: "Dashboard",
  data() {
    return {
      path: this.$route.path,
      open_time_menu: false,
      close_time_menu: false,
      lanch_time_start_menu: false,
      lanch_time_end_menu: false,
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: 'Weekday', value: 'label', sortable: false },
        { text: 'Open Time', value: 'open_time', sortable: false },
        { text: 'Close Time', value: 'close_time', sortable: false },
        { text: 'Lanch time start', value: 'lanch_time_start', sortable: false },
        { text: 'Lanch time end', value: 'lanch_time_end', sortable: false},
        { text: '', value: 'actions'},
      ],
      weekdays: [
        {
          week_day: 1,
          label: 'Monday',
          open_time: '',
          close_time: '',
          lanch_time_start: '',
          lanch_time_end: '',
        },
        {
          week_day: 2,
          label: 'Tuesday',
          open_time: '',
          close_time: '',
          lanch_time_start: '',
          lanch_time_end: '',
        },
        {
          week_day: 3,
          label: 'Wednesday',
          open_time: '',
          close_time: '',
          lanch_time_start: '',
          lanch_time_end: '',
        },
        {
          week_day: 4,
          label: 'Thursday',
          open_time: '',
          close_time: '',
          lanch_time_start: '',
          lanch_time_end: '',
        },
        {
          week_day: 5,
          label: 'Friday',
          open_time: '',
          close_time: '',
          lanch_time_start: '',
          lanch_time_end: '',
        },
        {
          week_day: 6,
          label: 'Saturday',
          open_time: '',
          close_time: '',
          lanch_time_start: '',
          lanch_time_end: '',
        },
        {
          week_day: 7,
          label: 'Sunday',
          open_time: '',
          close_time: '',
          lanch_time_start: '',
          lanch_time_end: '',
        }
      ],
      editedIndex: -1,
      editedItem: {
        open_time: '',
        close_time: '',
        lanch_time_start: '',
        lanch_time_end: '',
        week_day: '',
      }
    }
  },
  watch: {
    $route(to) {
      this.path = to.path;
    }
  },
  methods: {
    editItem (item) {
      this.editedIndex = this.weekdays.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },
    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },
    save () {
      const self = this;
      console.log(this.editedItem);
      this.$axios.post('http://localhost:8000/api/work-hours', this.editedItem)
      .then(response => {
        console.log(response)
        let weekDay = self.weekdays.find(weekday => weekday.week_day === +self.editedItem.week_day);
        console.log(weekDay)
        weekDay.open_time = self.editedItem.open_time;
        weekDay.close_time = self.editedItem.close_time;
        weekDay.lanch_time_start = self.editedItem.lanch_time_start;
        weekDay.lanch_time_end = self.editedItem.lanch_time_end;
        self.close()
      })
      
    },
  },
  created () {
    const self = this;

    this.$axios.get('http://localhost:8000/api/work-hours')
      .then(response => {
        console.log(response)
        response.data.forEach(res => {
          let weekDay = self.weekdays.find(weekday => weekday.week_day === +res.week_day);
          weekDay.open_time = res.open_time;
          weekDay.close_time = res.close_time;
          weekDay.lanch_time_start = res.lanch_time_start;
          weekDay.lanch_time_end = res.lanch_time_end;
        })
      })
  },
}
</script>

<style scoped>

</style>