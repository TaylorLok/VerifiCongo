<div>
    <form wire:submit.prevent="register">
        <div>
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" wire:model="first_name" required>
            @error('first_name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" wire:model="last_name" required>
            @error('last_name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="cellphone">Cellphone</label>
            <input type="tel" id="cellphone" wire:model="cellphone" required>
            @error('cellphone') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>
</div>
