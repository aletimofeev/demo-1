<template>
  <b-table
    :data="data"
    :loading="loading"
    :mobile-cards="false"
    :paginated="isPaginated"
    :pagination-simple="isPaginationSimple"
    :pagination-position="paginationPosition"
    backend-pagination
    backend-filtering
    :total="total"
    :per-page="perPage"
    aria-page-label="Page"
    aria-current-label="Current page"
    backend-sorting
    :default-sort-direction="defaultSortOrder"
    :default-sort="[sortField, sortOrder]"
    :debounce-search="500"
    @page-change="onPageChange"
    @sort="onSort"
    @filters-change="onFiltersChange"
  >
    <b-table-column
      v-slot="props"
      label="№"
    >
      {{ props.index + 1 + perPage * (page - 1) }}
    </b-table-column>
    <b-table-column
      field="lastname"
      label="Фамилия"
      sortable
      searchable
    >
      <template>
        <b-input
          placeholder="Поиск..."
          icon="magnify"
          size="is-small"
        />
      </template>
      <template v-slot="props">
        {{ props.row.lastname }}
        <!--        <router-link-->
        <!--          :to="{ name: 'AthleteShow', params: { id: props.row.id } }"-->
        <!--        >-->
        <!--          {{ props.row.fullName }}-->
        <!--        </router-link>-->
      </template>
    </b-table-column>

    <b-table-column
      field="firstname"
      label="Имя"
      sortable
      searchable
    >
      <template>
        <b-input
          placeholder="Поиск..."
          icon="magnify"
          size="is-small"
        />
      </template>
      <template v-slot="props">
        {{ props.row.firstname }}
      </template>
    </b-table-column>

    <b-table-column
      field="patronymic"
      label="Отчество"
      sortable
      searchable
    >
      <template>
        <b-input
          placeholder="Поиск..."
          icon="magnify"
          size="is-small"
        />
      </template>
      <template v-slot="props">
        {{ props.row.patronymic }}
      </template>
    </b-table-column>

    <b-table-column
      field="birthDate"
      label="Дата рождения"
      sortable
      searchable
    >
      <template #searchable="props">
        <b-select
          v-model="props.filters[props.column.field]"
          placeholder="Выберите год"
        >
          <option value="">
            Все даты
          </option>
          <option
            v-for="year in diffDates"
            :key="year"
            :value="year"
          >
            {{ year }}
          </option>
        </b-select>
      </template>
      <template v-slot="props">
        {{ props.row.birthDate | date }}
      </template>
    </b-table-column>

    <b-table-column
      v-slot="props"
      field="department.name"
      label="Отдел"
      sortable
      searchable
    >
      {{ props.row.department.name }}
    </b-table-column>

    <b-table-column
      v-slot="props"
      field="position.name"
      label="Должность"
      sortable
      searchable
    >
      {{ props.row.position.name }}
    </b-table-column>

    <b-table-column
      v-if="isEditor"
      v-slot="props"
      label="Действия"
    >
      <AppEditButtons
        @edit="handleEdit(props.row)"
        @remove="handleRemove(props.row)"
      />
    </b-table-column>
  </b-table>
</template>

<script>
import { mapGetters } from "vuex";
import {HYDRA, Resource} from "@/utils/const";
import {getQueryFilters, getAgeDiffDates} from "@/modules/employees/utils";
import AppEditButtons from "@/components/AppEditButtons";
import {DELETE_ERROR, DELETE_SUCCESS} from "@/utils/const-message";


export default {
  name: "ListEmployees",
  components: {AppEditButtons},
  filters: {
    date: function(value) {
      return new Date(value).toLocaleDateString();
    }
  },
  data() {
    return {
      isPaginated: true,
      isPaginationSimple: false,
      isPaginationRounded: false,
      paginationPosition: "bottom",

      data: [],
      total: 0,
      loading: false,
      sortField: "lastname",
      sortOrder: "asc",
      defaultSortOrder: "asc",
      page: 1,
      perPage: 10,

      diffDates: {},
      filters: [],
    };
  },
  computed: {
    ...mapGetters({
      isEditor: "auth/isEditor",
      user: "auth/getUser",
    }),
  },
  async mounted() {
    this.diffDates = getAgeDiffDates();
    await this.loadAsyncData();
    document.title = "Работники";
  },
  methods: {
    // async handleAdd() {
    //   console.log('add');
    //   // this.$buefy.modal.open({
    //   //   parent: this,
    //   //   component: AthleteForm,
    //   //   props: { athlete: defaultAthlete },
    //   //   events: { close: this.handleClose },
    //   //   hasModalCard: true,
    //   //   fullScreen: true,
    //   // });
    // },
    // async handleClose({ id }) {
    //   if (id) {
    //     await this.$router.push({ name: "AthleteShow", params: { id } });
    //   }
    // },
    async handleEdit(employee) {
      console.log(employee);
    },
    async handleRemove({id, lastname, firstname}) {
      this.$buefy.dialog.confirm({
        title: "Удаление работника",
        class: "is-size-4",
        message: `Работник ${lastname} ${firstname} будет удален. Операция не обратима! Продолжить?`,
        cancelText: "Отмена",
        confirmText: "Да",
        hasIcon: true,
        type: "is-danger",
        onConfirm: async () => {
          try {
            await this.$api[Resource.EMPLOYEES].delete(id);
            await this.loadAsyncData();
            this.$notifier.success(DELETE_SUCCESS);
          } catch (e) {
            this.$notifier.error(e.response.data.message || DELETE_ERROR);
          }
        },
      });
    },
    async onPageChange(page) {
      this.page = page;
      await this.loadAsyncData();
    },
    async onFiltersChange(filters) {
      this.filters = await getQueryFilters(filters);
      await this.loadAsyncData();
    },
    async onSort(field, order) {
      this.sortField = field;
      this.sortOrder = order;
      await this.loadAsyncData();
    },
    async loadAsyncData() {
      const params = [
          `?itemsPerPage=${this.perPage}`,
          `page=${this.page}`,
          `order[${this.sortField}]=${this.sortOrder}`,
          ...this.filters
      ].join("&")
      this.loading = true;

      try {
        const data = await this.$api[Resource.EMPLOYEES].get(params);
        this.data = data[HYDRA.DATA];
        this.total = data[HYDRA.COUNT];

        this.loading = false;
      } catch (e) {
        console.log(e);
        this.data = [];
        this.total = 0;
        this.loading = false;
      }
    },
  },
};
</script>
