<template>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center text-blue-900">Domain List</h1>
        <div class="mb-4">
            <input v-model="search"
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Search domain..." />
        </div>
        <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
            <tr class="bg-blue-500 text-white">
                <th class="px-4 py-2">Domain Name</th>
                <th class="px-4 py-2">Page Rank</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="domain in filteredDomains" :key="domain.id" class="border-t">
                <td class="px-4 py-2 text-center">{{ domain.domain }}</td>
                <td class="px-4 py-2 text-center">{{ domain.pagerank }}</td>
            </tr>
            </tbody>
        </table>
        <div class="flex justify-between mt-4">
            <button @click="prevPage"
                    :disabled="!pagination.prev_page_url"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 disabled:opacity-50">
                Previous
            </button>
            <button @click="nextPage"
                    :disabled="!pagination.next_page_url"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50">
                Next
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            domains: [],
            search: '',
            pagination: {}
        };
    },
    computed: {
        filteredDomains() {
            return this.domains.filter(domain =>
                domain.domain.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    },
    methods: {
        fetchDomains(pageUrl = '/api/domains') {
            axios.get(pageUrl).then(response => {
                this.domains = response.data.data;
                this.pagination = response.data;
            });
        },
        nextPage() {
            if (this.pagination.next_page_url) {
                this.fetchDomains(this.pagination.next_page_url);
            }
        },
        prevPage() {
            if (this.pagination.prev_page_url) {
                this.fetchDomains(this.pagination.prev_page_url);
            }
        }
    },
    mounted() {
        this.fetchDomains();
    }
};
</script>
