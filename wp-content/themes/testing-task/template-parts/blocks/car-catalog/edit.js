import { useState } from "@wordpress/element";

export default function Edit() {
  const [brand, setBrand] = useState("");

  return (
    <div className="car-catalog-block">
      <h3>React-based Car Catalog Block</h3>
      <label>Filter by brand:</label>
      <input
        type="text"
        value={brand}
        onChange={(e) => setBrand(e.target.value)}
      />
    </div>
  );
}
