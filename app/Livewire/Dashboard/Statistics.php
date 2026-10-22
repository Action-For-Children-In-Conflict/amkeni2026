<?php

namespace App\Livewire\Dashboard;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Event;
use App\Models\Membership;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Publication;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\Testmonial;
use App\Models\User;
use App\Models\Volunteer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Statistics extends Component
{
    /**
     * The content models shown on the dashboard.
     *
     * @return array<int, array{label: string, count: int, this_month: int, icon: string, route: string|null}>
     */
    public function contentStatistics(): array
    {
        return [
            $this->statistic(__('Programs'), Program::class, 'play', 'admin.programs.index'),
            $this->statistic(__('Blog Posts'), Blog::class, 'newspaper', 'admin.blogs.index'),
            $this->statistic(__('Events'), Event::class, 'calendar', 'admin.events.index'),
            $this->statistic(__('Publications'), Publication::class, 'document-text', 'admin.publications.index'),
            $this->statistic(__('Success Stories'), Testmonial::class, 'chat-bubble-left', 'admin.testmonials.index'),
            $this->statistic(__('Partners'), Partner::class, 'user-group', 'admin.partners.index'),
            $this->statistic(__('Staff'), Staff::class, 'users', 'admin.staff.index'),
            $this->statistic(__('Volunteers'), Volunteer::class, 'hand-raised'),
            $this->statistic(__('Categories'), Category::class, 'square-2-stack', 'admin.categories.index'),
            $this->statistic(__('Tags'), Tag::class, 'tag', 'admin.tags.index'),
        ];
    }

    /**
     * The platform models shown on the dashboard.
     *
     * @return array<int, array{label: string, count: int, this_month: int, icon: string, route: string|null}>
     */
    public function platformStatistics(): array
    {
        return [
            $this->statistic(__('Users'), User::class, 'user'),
            $this->statistic(__('Teams'), Team::class, 'user-group'),
            $this->statistic(__('Team Members'), Membership::class, 'users'),
            $this->statistic(
                __('Pending Invitations'),
                TeamInvitation::class,
                'envelope',
                scope: fn (Builder $query) => $query
                    ->whereNull('accepted_at')
                    ->where(fn (Builder $query) => $query->whereNull('expires_at')->orWhere('expires_at', '>', now())),
            ),
        ];
    }

    public function render(): View
    {
        $content = $this->contentStatistics();

        return view('livewire.dashboard.statistics', [
            'contentStats' => $content,
            'contentTotal' => array_sum(array_column($content, 'count')),
            'platformStats' => $this->platformStatistics(),
        ]);
    }

    /**
     * Build a single statistic, including how many records were created this month.
     *
     * @param  class-string<Model>  $model
     * @param  (Closure(Builder): mixed)|null  $scope
     * @return array{label: string, count: int, this_month: int, icon: string, route: string|null}
     */
    protected function statistic(string $label, string $model, string $icon, ?string $route = null, ?Closure $scope = null): array
    {
        $query = $model::query();

        if ($scope !== null) {
            $scope($query);
        }

        return [
            'label' => $label,
            'count' => (clone $query)->count(),
            'this_month' => (clone $query)->where('created_at', '>=', now()->startOfMonth())->count(),
            'icon' => $icon,
            'route' => $route,
        ];
    }
}
