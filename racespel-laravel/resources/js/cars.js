document.addEventListener('DOMContentLoaded', () => {
  const brandSelect = document.getElementById('brand');
  const modelSelect = document.getElementById('model');
  const confirmBtn = document.getElementById('confirmCar');

  const preview = document.getElementById('carPreview');
  const previewSwatch = document.getElementById('carSwatch');
  const previewName = document.getElementById('carPreviewName');
  const previewSpeed = document.getElementById('carSpeedDots');

  const catalog = window.CAR_CATALOG || {};
  const selectedCarId = window.SELECTED_CAR_ID;

  function carsForBrand(brand) {
    return catalog[brand] || [];
  }

  function populateModels(brand, preselectCarId = null) {
    modelSelect.innerHTML = '';

    const cars = carsForBrand(brand);

    if (!brand || cars.length === 0) {
      modelSelect.disabled = true;
      modelSelect.appendChild(new Option('Select a brand first…', ''));
      hidePreview();
      updateConfirmState();
      return;
    }

    modelSelect.disabled = false;
    modelSelect.appendChild(new Option('Select a model…', ''));

    cars.forEach((car) => {
      const option = new Option(car.model, car.id);
      modelSelect.appendChild(option);
    });

    if (preselectCarId) {
      modelSelect.value = String(preselectCarId);
    }

    updatePreview();
    updateConfirmState();
  }

  function updateConfirmState() {
    confirmBtn.disabled = !modelSelect.value;
  }

  function hidePreview() {
    preview.hidden = true;
  }

  function updatePreview() {
    const carId = modelSelect.value;
    const cars = carsForBrand(brandSelect.value);
    const car = cars.find((c) => String(c.id) === String(carId));

    if (!car) {
      hidePreview();
      return;
    }

    preview.hidden = false;
    previewSwatch.style.background = car.color;
    previewSwatch.style.boxShadow = `0 0 14px ${car.color}`;
    previewName.textContent = `${car.brand} ${car.model}`;
    previewSpeed.textContent = '●'.repeat(car.speed_rating) + '○'.repeat(5 - car.speed_rating);
  }

  brandSelect.addEventListener('change', () => populateModels(brandSelect.value));
  modelSelect.addEventListener('change', () => {
    updatePreview();
    updateConfirmState();
  });

  // Restore the previously selected car on page load, if any.
  if (selectedCarId) {
    for (const [brand, cars] of Object.entries(catalog)) {
      if (cars.some((c) => c.id === selectedCarId)) {
        brandSelect.value = brand;
        populateModels(brand, selectedCarId);
        break;
      }
    }
  }
});
