import { Routes } from '@angular/router';
import { AppLayout } from './app/layout/component/app.layout';
import { Dashboard } from './app/pages/dashboard/dashboard';
import { Documentation } from './app/pages/documentation/documentation';
import { Landing } from './app/pages/landing/landing';
import { Notfound } from './app/pages/notfound/notfound';

export const appRoutes: Routes = [
    {
        path: '',
        component: AppLayout,
        children: [
            { path: '', component: Dashboard },
            { path: 'uikit', loadChildren: () => import('./app/pages/uikit/uikit.routes') },
            { path: 'documentation', component: Documentation },
            { path: 'pages', loadChildren: () => import('./app/pages/pages.routes') },
            { path: 'nhansu', loadComponent: () => import('./app/pages/modules/nhanSu/NhanSuComponent').then((m) => m.NhanSuComponent) },
            { path: 'thuongmai', loadComponent: () => import('./app/pages/modules/thuongMai/ThuongMaiComponent').then((m) => m.ThuongMaiComponent) },
            { path: 'kehoach', loadComponent: () => import('./app/pages/modules/kehoach/ke-hoach.component').then((m) => m.KeHoachComponent) }
        ]
    },
    { path: 'landing', component: Landing },
    { path: 'notfound', component: Notfound },
    { path: 'auth', loadChildren: () => import('./app/pages/auth/auth.routes') },
    { path: '**', redirectTo: '/notfound' }
];
