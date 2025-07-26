<section class="filters">
  <div class="container">
    <form class="catalog__filters grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6 items-center" action="/catalog/" method="GET">
      <input
        type="text"
        name="search"
        placeholder="Пошук за назвою або описом"
        class="px-4 py-2 border rounded w-full"
      />

      <div class="dropdown-checkbox w-full" data-name="brand" data-legend="Бренди"></div>
      <div class="dropdown-checkbox w-full" data-name="category" data-legend="Категорії"></div>

      <select name="sort" class="px-4 py-2 border rounded w-full">
        <option value="newest">Від нових до старих</option>
        <option value="oldest">Від старих до нових</option>
        <option value="expensive">Від дорожчих до дешевших</option>
        <option value="cheap">Від дешевших до дорожчих</option>
        <option value="az">Назва: A → Z</option>
        <option value="za">Назва: Z → A</option>
      </select>

      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded col-span-1 lg:col-span-4">
        Знайти
      </button>
    </form>
  </div>
</section>
