export function showLoader() {
  const loader = document.querySelector("#loader-spinner");
  loader.classList.remove("hidden");
}

export function hideLoader() {
  const loader = document.querySelector("#loader-spinner");
  loader.classList.add("hidden");
}
