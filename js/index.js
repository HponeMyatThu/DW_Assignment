const modal = document.getElementById("toaster");
if (modal) {
  modal.classList.add("show");
  setTimeout(() => {
    modal.classList.remove("show");
  }, 3000);
}

