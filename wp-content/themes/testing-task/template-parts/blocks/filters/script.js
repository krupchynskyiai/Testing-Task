document.addEventListener('DOMContentLoaded', () => {
  const isCatalogPage = document.querySelector('section.list');
  const form = document.querySelector('form.catalog__filters');

  if (!form || !isCatalogPage) return;

  const sortSelect = form.querySelector('select[name="sort"]');
  const searchInput = form.querySelector('input[name="search"]');

  const selectedValues = {
    brand: [],
    category: []
  };

  async function loadFilters() {
    try {
      const response = await fetch('/wp-json/testing-task/v1/cars', {
        headers: {
          Authorization: `Bearer ${secretData.apiToken}`
        }
      });

      if (!response.ok) throw new Error('HTTP Error: ' + response.status);
      const data = await response.json();

      createDropdown('brand', 'Бренди', data.brands);
      createDropdown('category', 'Категорії', data.categories);
    } catch (error) {
      console.error('Помилка при завантаженні фільтрів:', error);
    }
  }

  function createDropdown(name, legend, options) {
    const container = document.querySelector(`.dropdown-checkbox[data-name="${name}"]`);
    if (!container) return;

    container.innerHTML = '';

    const state = {
      open: false,
      selected: []
    };

    const wrapper = document.createElement('div');
    wrapper.className = 'relative w-full';

    const button = document.createElement('button');
    button.type = 'button';
    button.className =
      'flex items-center bg-gray-100 px-4 py-2 border rounded w-full overflow-hidden';
    button.addEventListener('click', () => {
      state.open = !state.open;
      dropdown.style.display = state.open ? 'block' : 'none';
    });

    const displaySpan = document.createElement('span');
    displaySpan.className = 'block overflow-hidden text-ellipsis whitespace-nowrap w-full';
    button.appendChild(displaySpan);

    const dropdown = document.createElement('div');
    dropdown.className =
      'absolute z-10 mt-1 w-full bg-white border shadow p-2 max-h-60 overflow-auto rounded';
    dropdown.style.display = 'none';

    Object.entries(options).forEach(([slug, label]) => {
      const labelEl = document.createElement('label');
      labelEl.className = 'block cursor-pointer';

      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.name = name + '[]';
      checkbox.value = slug;
      checkbox.className = 'mr-2';

      checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
          state.selected.push(slug);
        } else {
          state.selected = state.selected.filter((val) => val !== slug);
        }
        selectedValues[name] = [...state.selected];
        updateDisplay();
      });

      labelEl.appendChild(checkbox);
      labelEl.append(label);
      dropdown.appendChild(labelEl);
    });

    wrapper.appendChild(button);
    wrapper.appendChild(dropdown);
    container.appendChild(wrapper);

    const updateDisplay = () => {
      displaySpan.textContent =
        state.selected.length > 0
          ? state.selected.map((val) => options[val]).join(', ')
          : `Усі ${legend.toLowerCase()}`;
    };

    updateDisplay();

    // Закриття дропдауну при кліку поза межами
    document.addEventListener('click', (e) => {
      if (!container.contains(e.target)) {
        state.open = false;
        dropdown.style.display = 'none';
      }
    });
  }

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const sortValue = sortSelect?.value;
    const searchValue = searchInput?.value?.trim();

    let url = '/catalog/';

    if (selectedValues.brand.length) {
      url += `brand/${selectedValues.brand.join(',')}/`;
    }

    if (selectedValues.category.length) {
      url += `category/${selectedValues.category.join(',')}/`;
    }

    if (sortValue) {
      url += `sort/${encodeURIComponent(sortValue)}/`;
    }

    if (searchValue) {
      url += `search/${encodeURIComponent(searchValue)}/`;
    }

    window.location.href = url;
  });

  loadFilters();
});
