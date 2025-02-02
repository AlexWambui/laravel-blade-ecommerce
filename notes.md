TODOs:
App
- Implement pagination.

Admin
- Can reply to user messages via email or sms.

Users
- ~~Fix old images not being deleted when updating the profile.~~
- Finish taking care of authentication pages.



public function getStatusClassAttribute(): string
{
    return $this->status === 0 ? 'unread' : 'read';
}