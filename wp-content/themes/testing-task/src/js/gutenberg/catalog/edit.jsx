import { __ } from '@wordpress/i18n';

export default function Edit() {
    return (
        <div className="wp-block-testing-task-catalog" style={{ padding: '1rem', background: '#f5f5f5' }}>
            {__('Catalog Block (тільки фронт)', 'testing-task')}
        </div>
    );
}
