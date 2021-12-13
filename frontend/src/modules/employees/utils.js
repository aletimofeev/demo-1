export const getQueryFilters = async (filters) => {
  const queryFilters = [];
  Object.keys(filters).forEach((key) => {
    if (key === "birthDate" && typeof filters[key] === "number") {
      const startYear = `${filters[key]}-01-01`;
      const endYear = `${filters[key] + 1}-01-01`;
      queryFilters.push(`${key}[after]=${startYear}`);
      queryFilters.push(`${key}[before]=${endYear}`);
    } else if (filters[key].length >= 3) {
      queryFilters.push(`${key}=${filters[key]}`);
    }
  });

  return queryFilters;
};

const AGE_MAX_YEAR = 16;
const AGE_MIN_YEAR = 75;

export const getAgeDiffDates = () => {
  const year = new Date().getFullYear();
  const max = year - AGE_MAX_YEAR;
  const years = [];
  for (let i = year - AGE_MIN_YEAR; i <= max; i++) {
    years.push(i);
  }
  return years.reverse();
};
