import React from 'react';
import { createRoot } from 'react-dom/client';
import CatalogApp from './CatalogApp';

document.addEventListener('DOMContentLoaded', () => {
	const el = document.getElementById('catalog-block-root');
	console.log(el)
	if (el) {
		const root = createRoot(el);
		root.render(<CatalogApp apiToken={secretData.apiToken} />);
	}
});