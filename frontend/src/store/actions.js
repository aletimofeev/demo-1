import { uniqueId } from "lodash";
import {
  ADD_NOTIFICATION,
  DELETE_NOTIFICATION,
  SET_ENTITY,
} from "./mutation-types";
import { MESSAGE_LIVE_TIME } from "@/utils/const";

export default {
  async init({ dispatch }) {
    await dispatch("auth/getMe");
  },

  async createNotification({ commit }, { ...notification }) {
    const uniqueNotification = {
      ...notification,
      id: uniqueId(),
    };
    commit(ADD_NOTIFICATION, uniqueNotification);
    setTimeout(
      () => commit(DELETE_NOTIFICATION, uniqueNotification.id),
      MESSAGE_LIVE_TIME
    );
  },
  async setErrors({ commit }, errors) {
    commit(SET_ENTITY, { entity: errors, value: errors });
  },
};
