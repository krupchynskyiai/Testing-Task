import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import Save from './save';


registerBlockType('testing-task/catalog', {
  title: __('Каталог машин', 'testing-task'),
  description: __('Блок з фільтрацією машин', 'testing-task'),
  category: 'widgets',
  icon: 'car',
  supports: {
    html: false,
  },
  edit: Edit,
  save: Save,
});
