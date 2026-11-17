import { lazy, Suspense } from 'react';

const MarkdownEditorImpl = lazy(() => import('./MarkdownEditorImpl'));

export default function MarkdownEditor({ value = '', onChange, height = '55vh' }) {
    return (
        <Suspense fallback={<div className="flex h-24 items-center justify-center text-sm text-slate-500" role="status">Memuat editor...</div>}>
            <MarkdownEditorImpl value={value} onChange={onChange} height={height} />
        </Suspense>
    );
}
