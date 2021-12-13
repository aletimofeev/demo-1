import { Entity } from "./const";

export default {
  getUser: (state) => {
    return state[Entity.USER];
  },
  isEditor: (state) => {
    return state[Entity.USER]?.roles?.includes("ROLE_EDITOR") || false;
  },
};
