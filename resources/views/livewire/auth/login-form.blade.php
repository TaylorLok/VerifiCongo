<div>
    <form wire:submit.prevent="login">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <input type="checkbox" id="remember" wire:model="remember">
            <label for="remember">Remember me</label>
        </div>

        <button type="submit">Login</button>
    </form>
</div>
