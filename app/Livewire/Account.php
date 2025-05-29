<?php

namespace App\Livewire;

use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\User;

class Account extends Component
{
    public $user;
    public $users;

    public $edit = false;
    public $name;
    public $email;
    public $password;
    public $passwordConfirm;

    public $permissions = [
        "tester" => "Tester",
        "notes" => "Notes",
        "redirects" => "Redirects",
        "portfolio" => "Portfolio",
        "cv" => "Cv",
        "timetracking" => "Timetracking",
    ];

    private function fillUsers()
    {
        $this->users = User::where("id", "!=", $this->user->id)->get();
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->fillUsers();
    }

    public function logout()
    {
        Auth::logout();
        $this->js("window.location.reload()");
    }

    public function requestAccess($permission)
    {
        $this->user->generatePermissionsToken();
        $this->user->save();

        Mail::to("hp@diesing.pro")->queue(
            new \App\Mail\RequestAccess([
                "user" => $this->user,
                "permission" => $permission,
            ])
        );

        session()->flash("status", __("text.access_request_sent"));
    }

    public function deleteUser($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash("status", __("text.user_deleted"));
            $this->fillUsers();
        }
    }

    public function loginUser($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $user = User::find($id);
        if ($user) {
            Auth::login($user);
            $this->js("window.location.reload()");
        }
    }

    public function togglePermission($id, $permission)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $user = User::find($id);
        if ($user && !$user->isAdmin()) {
            $current = $user->getPermission($permission);
            $user->setPermission($permission, !$current);
            $user->save();
            $this->fillUsers();

            session()->flash('status', __('text.permissions_updated'));
        }
    }

    public function editAccount()
    {
        $this->edit = true;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->password = '';
        $this->passwordConfirm = '';
    }

    public function cancelEdit()
    {
        $this->edit = false;
    }

    public function saveAccount()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            session()->flash('error', __('text.invalid_email'));
            return;
        }

        if (empty($this->name)) {
            session()->flash('error', __('text.name_empty'));
            return;
        }

        if (User::where('email', $this->email)->where('id', '!=', $this->user->id)->exists()) {
            session()->flash('error', __('text.email_exists'));
            return;
        }

        if (!empty($this->password)) {
            if ($this->password !== $this->passwordConfirm) {
                session()->flash('error', __('text.passwords_do_not_match'));
                return;
            }
            $this->user->password = bcrypt($this->password);
        }

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->save();

        $this->edit = false;
        session()->flash('status', __('text.account_updated'));
    }

    public function render()
    {
        return view("livewire.account");
    }
}
