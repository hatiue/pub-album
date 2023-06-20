<html>
<head>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <a href="{{ route('dashboard') }}">ダッシュボード行き</a><br>
    Alpine.jsのドキュメント StartHereのところ
    <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>

    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
        <span x-text="count * 2"></span>
        <span x-text="count / 2"></span>
    </div>


    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>
        <div x-show="open" @click.outside="open = false">Contents...</div>
    </div>


    <div
        x-data="{
            search: '',
    
            items: ['foo', 'bar', 'baz'],
    
            get filteredItems() {
                return this.items.filter(
                    i => i.startsWith(this.search)
                )
            }
        }"
    >
    <input x-model="search" placeholder="Search...">
    <ul>
        <template x-for="item in filteredItems" :key="item">
            <li x-text="item"></li>
        </template>
    </ul>
    </div>
</body>
</html>