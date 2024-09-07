<?php
// -------------my code-----------------

namespace App\Http\Profile;

class Profile extends Controller 
    {
        public function edit()
        {
            if (!$this->ionAuth->loggedIn()) {
                return redirect()->to('/login');
            }
    
            $user = $this->ionAuth->user()->row();
    
            if ($this->request->getMethod() === 'post') {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                ];
    
                if ($this->ionAuth->update($user->id, $data)) {
                    return redirect()->to('/profile');
                } else {
                    $data['error'] = $this->ionAuth->errors();
                }
            }
    
            return view('profile/edit', ['user' => $user]);
        }
    }