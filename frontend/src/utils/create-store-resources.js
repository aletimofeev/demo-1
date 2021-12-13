import { AuthApiService } from "@/service/api";
import { Resource } from "@/utils/const";

export default (notifier) => {
  return {
    [Resource.AUTH]: new AuthApiService(notifier),
  };
};
