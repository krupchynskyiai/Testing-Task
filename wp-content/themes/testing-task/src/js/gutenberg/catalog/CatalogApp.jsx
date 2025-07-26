import React, { useEffect, useState } from "react";

const CarCardSkeleton = () => (
  <div className="car-card h-fit p-2 bg-slate-300 rounded-lg flex flex-col gap-4 animate-pulse">
    <div className="car-card__photo overflow-hidden rounded-md bg-slate-400 h-64 lg:h-96 w-full" />
    <ul className="car-card__info">
      <li className="car-card__title h-6 w-3/4 bg-slate-400 rounded mb-2" />
      <li className="car-card__price h-5 w-1/3 bg-slate-400 rounded" />
    </ul>
  </div>
);

const CarCard = ({ car }) => (
  <a
    href={car.link}
    title={car.title}
    className="car-card h-fit p-2 bg-sky-500/30 rounded-lg flex flex-col gap-4"
  >
    <span className="car-card__photo overflow-hidden rounded-md">
      {car.label && <span className="car-card__label">{car.label}</span>}
      <picture>
        <source srcSet={car.imageWebp} />
        <img
          src={car.image}
          alt={car.title}
          title={car.title}
          width="220"
          height="250"
          className="car-card__image h-64 lg:h-96 w-full object-cover"
        />
      </picture>
    </span>
    <ul className="car-card__info">
      <li className="car-card__title">
        <span>{car.title}</span>
      </li>
      <li className="car-card__price">
        <span>{car.price}$</span>
      </li>
    </ul>
  </a>
);

const DropdownCheckbox = ({ legend, options, selected, name, onChange }) => {
  const [open, setOpen] = useState(false);

  return (
    <div className="relative w-full max-w-[100%]">
      <button
        type="button"
        className="flex items-center bg-gray-100 px-4 py-2 max-w-[100%] border rounded cursor-pointer w-full overflow-hidden"
        onClick={() => setOpen(!open)}
      >
        <span className="block overflow-hidden text-ellipsis whitespace-nowrap w-full">
          {selected.length > 0
            ? selected.map((slug) => options[slug]).join(", ")
            : `Усі ${legend.toLowerCase()}`}
        </span>
      </button>

      {open && (
        <div className="absolute z-10 mt-1 w-full bg-white border shadow p-2 max-h-60 overflow-auto rounded">
          {Object.entries(options).map(([slug, label]) => (
            <label key={slug} className="block">
              <input
                type="checkbox"
                name={name}
                value={slug}
                checked={selected.includes(slug)}
                onChange={onChange}
                className="mr-2"
              />
              {label}
            </label>
          ))}
        </div>
      )}
    </div>
  );
};

const parseUrl = (pathname) => {
  const parts = pathname.replace(/^\/|\/$/g, "").split("/");

  let brand = [];
  let category = [];
  let sort = "";
  let search = "";
  let page = 1;

  for (let i = 0; i < parts.length; i++) {
    switch (parts[i]) {
      case "brand":
        if (parts[i + 1]) {
          brand = parts[i + 1].split(",");
          i++;
        }
        break;
      case "category":
        if (parts[i + 1]) {
          category = parts[i + 1].split(",");
          i++;
        }
        break;
      case "sort":
        if (parts[i + 1]) {
          sort = decodeURIComponent(parts[i + 1]);
          i++;
        }
        break;
      case "search":
        if (parts[i + 1]) {
          search = decodeURIComponent(parts[i + 1]);
          i++;
        }
        break;
      case "page":
        if (parts[i + 1]) {
          page = parseInt(parts[i + 1], 10) || 1;
          i++;
        }
        break;
    }
  }

  return { brand, category, sort, search, page };
};

const buildUrl = ({ brand = [], category = [], sort = "", search = "", page = 1 }) => {
  let url = "/catalog/";

  if (brand.length > 0) {
    url += `brand/${brand.join(",")}/`;
  }

  if (category.length > 0) {
    url += `category/${category.join(",")}/`;
  }

  if (sort) {
    url += `sort/${encodeURIComponent(sort)}/`;
  }

  if (search) {
    url += `search/${encodeURIComponent(search)}/`;
  }

  if (page > 1) {
    url += `page/${page}/`;
  }

  return url;
};


const CatalogApp = ({ apiToken }) => {
  const [cars, setCars] = useState([]);
  const [filters, setFilters] = useState({
    brand: [],
    category: [],
  });
  const [search, setSearch] = useState("");
  const [brands, setBrands] = useState({});
  const [categories, setCategories] = useState({});
  const [sort, setSort] = useState("newest");
  const [loading, setLoading] = useState(false);
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [loadType, setLoadType] = useState("reset");
  const [initialized, setInitialized] = useState(false);

  useEffect(() => {
    const parsed = parseUrl(window.location.pathname);

    setFilters({ brand: parsed.brand, category: parsed.category });
    setSort(parsed.sort || "newest");
    setSearch(parsed.search || "");
    setPage(parsed.page);
    setLoadType("reset");
    setInitialized(true);
  }, []);

  useEffect(() => {
    const newUrl = buildUrl({
      brand: filters.brand,
      category: filters.category,
      sort,
      search,
      page,
    });

    if (window.location.pathname !== newUrl) {
      window.history.pushState(null, "", newUrl);
    }
  }, [filters, sort, search, page]);

  useEffect(() => {
    if (!initialized) return;
    if (page === 0) return;
    console.log(loadType);
    if (loadType === "reset") {
      fetchCars(true);
    } else {
      fetchCars(false);
    }
  }, [filters, page, loadType, sort, search]);

  useEffect(() => {
    if (!initialized) return;
    const delayDebounce = setTimeout(() => {
      setLoadType("reset");
      setPage(1);
    }, 500);

    return () => clearTimeout(delayDebounce);
  }, [search]);

  useEffect(() => {
    if (!initialized) return;
    console.log("setting reset");
    setLoadType("reset");
    if (!page) {
      setPage(1);
    }
  }, [filters.brand, filters.category, sort]);

  const fetchCars = async (reset = false) => {
    setLoading(true);
    console.log("request sent");
    console.log(filters.brand);
    try {
      const query = new URLSearchParams({
        brand: filters.brand.join(","),
        category: filters.category.join(","),
        sort,
        page,
        per_page: 9,
        search: search.trim(),
      }).toString();

      const response = await fetch(`/wp-json/testing-task/v1/cars?${query}`, {
        headers: {
          Authorization: `Bearer ${apiToken}`,
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();

      if (reset) {
        setCars(data.cars);
      } else {
        setCars((prev) => [...prev, ...data.cars]);
      }
      setBrands(data.brands || brands);
      setCategories(data.categories || categories);
      setTotalPages(data.total_pages || 1);
      setPage(data.current_page || 1);
    } catch (e) {
      console.error("Помилка при завантаженні:", e);
    } finally {
      setLoading(false);
    }
  };

  const handleFilterChange = (e) => {
    const { name, value, checked } = e.target;

    if (name !== "brand" && name !== "category") return;

    setFilters((prev) => {
      const current = prev[name] || [];
      let updated;

      if (checked) {
        updated = [...current, value];
      } else {
        updated = current.filter((v) => v !== value);
      }

      return {
        ...prev,
        [name]: updated,
      };
    });
  };

  const loadMore = () => {
    if (page < totalPages && !loading) {
      setLoadType("append");
      setPage((p) => p + 1);
    }
  };

  return (
    <div className="catalog">
      <div className="container">
        <div className="catalog__content flex flex-col gap-4">
          <div className="catalog__filters grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6 items-center">
            <input
              type="text"
              placeholder="Пошук за назвою або описом"
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              className="px-4 py-2 border rounded w-72 w-full"
            />

            <DropdownCheckbox
              legend="Бренди"
              options={brands}
              selected={filters.brand}
              name="brand"
              onChange={handleFilterChange}
            />

            <DropdownCheckbox
              legend="Категорії"
              options={categories}
              selected={filters.category}
              name="category"
              onChange={handleFilterChange}
            />

            <select
              onChange={(e) => setSort(e.target.value)}
              value={sort}
              className="px-4 py-2 border rounded w-full"
            >
              <option value="newest">Від нових до старих</option>
              <option value="oldest">Від старих до нових</option>
              <option value="expensive">Від дорожчих до дешевших</option>
              <option value="cheap">Від дешевших до дорожчих</option>
              <option value="az">Назва: A → Z</option>
              <option value="za">Назва: Z → A</option>
            </select>
          </div>

          {loading && page === 1 ? (
            <div className="catalog__list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
              {[...Array(9)].map((_, i) => (
                <CarCardSkeleton key={i} />
              ))}
            </div>
          ) : (
            <>
              <div className="catalog__list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
                {cars.length ? (
                  cars.map((car) => <CarCard key={car.id} car={car} />)
                ) : (
                  <p>Нічого не знайдено.</p>
                )}
              </div>

              {page < totalPages && (
                <div className="flex justify-center mt-6">
                  <button
                    onClick={loadMore}
                    disabled={loading}
                    className="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50"
                  >
                    {loading ? "Завантаження..." : "Показати ще"}
                  </button>
                </div>
              )}
            </>
          )}
          {totalPages > 1 && (
            <div className="flex flex-wrap justify-center gap-2 mt-8">
              {Array.from({ length: totalPages }, (_, i) => i + 1).map(
                (pageNumber) => (
                  <button
                    key={pageNumber}
                    onClick={() => {
                      setLoadType("reset");
                      setPage(pageNumber);
                    }}
                    disabled={loading || pageNumber === page}
                    className={`px-4 py-2 rounded border text-sm transition ${
                      pageNumber === page
                        ? "bg-blue-600 text-white"
                        : "bg-white text-blue-600 hover:bg-blue-100"
                    }`}
                  >
                    {pageNumber}
                  </button>
                )
              )}
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default CatalogApp;