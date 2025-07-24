import { registerBlockType } from "@wordpress/blocks";
import edit from "./edit";
import save from "./save";

registerBlockType("custom/car-catalog", {
  title: "Car Catalog",
  icon: "car",
  category: "widgets",
  edit,
  save,
});
