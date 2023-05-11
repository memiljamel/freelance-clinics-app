const containersElement = [].slice.call(
  document.querySelectorAll('[data-te-container="images"]')
);

containersElement.map((containerElement) => {
  const inputElement = containerElement.querySelector(
    'input[accept="image/*"]'
  );

  inputElement.addEventListener('change', () => {
    const file = inputElement.files[0];
    const reader = new FileReader();

    if (file) {
      reader.addEventListener('load', () => {
        const imageElement = containerElement.getElementsByTagName('img');
        imageElement[0].src = reader.result;
        imageElement[0].alt = 'Preview avatar';
      });
      
      reader.readAsDataURL(file);
    }
  });
});
