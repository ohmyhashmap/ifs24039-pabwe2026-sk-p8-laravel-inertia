import { lazy, Suspense } from 'react';

const MarkdownViewerImpl = lazy(() => import('./MarkdownViewerImpl'));

export default function MarkdownViewer({ content = '' }) {
    return (
        <Suspense fallback={<div className="py-4 text-sm text-slate-500" role="status">Memuat artikel...</div>}>
            <MarkdownViewerImpl content={content} />
        </Suspense>
    );
}
