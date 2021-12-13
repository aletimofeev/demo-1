import { CrudApiService } from "@/service/api";
import { Resource } from "@/utils/const";

export default (notifier) => {
  return {
    [Resource.EMPLOYEES]: new CrudApiService(Resource.EMPLOYEES, notifier),
  };
};
