<script setup>

import MagnifyingGlass from '@/Components/Icons/MagnifyingGlass.vue';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';


defineProps({
    students: {
        type: Object,
        required: true
    },
});


const  deleteForm = useForm({});

const deleteStudent = (studentId) => {
    if (confirm("Are you sure you want to delete this student?")) {
        deleteForm.delete(route("students.destroy", studentId));
    }
    
};

console.log(usePage().props.students);
</script>

<template>

    <Head title="Students list" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Student
            </h2>
        </template>
        <div class="bg-gray-100 py-1-">

            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <div class="sm:flex-atuo ">
                            <h1 class="text-2xl font-bold leading-tight text-gray-900">Students</h1>
                            <p class="mt-t text-sm text-gray-700">
                                A list of all students
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-4 sm:flex-none">
                            <Link :href="route('students.create')"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">
                            Add Student
                            </Link>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between  sm:flex-row mt-6">
                        <div class="relative text-sm text-gray-800 col-span-3">
                            <div
                                class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                                <MagnifyingGlass />

                            </div>

                            <input type="text" placeholder="Search for students..." id="search" class="block  rounded-lg border-0 py-2 pl-10 text-gray-900
                            ring-1 ring-insert ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-insert focus:ring-blue-600
                            sm:text-ms sm:leading-6" />

                        </div>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div
                                    class="overflow-hidden show ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    ID</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Email
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Class
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Section </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Date
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="student in students.data" :key="student.id">

                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-meium text-gray-900 sm:pl-6">
                                                    {{ student.id }}</td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-meium text-gray-900 sm:pl-6">
                                                    {{ student.name }}</td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-meium text-gray-900 sm:pl-6">
                                                    {{ student.email }}</td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-meium text-gray-900 sm:pl-6">
                                                    {{ student.class.name }}</td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-meium text-gray-900 sm:pl-6">
                                                    {{ student.section.name }}</td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-meium text-gray-900 sm:pl-6">
                                                    {{ student.created_at }}</td>
                                                <td
                                                    class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <Link 
                                                    :href="route('students.edit', student.id)"
                                                     class="text-blue-600 hover:text-blue-900">Edit</Link> 
                                                    <button @click="deleteStudent(student.id)"  class="text-red-600 hover:text-red-900">Delete</button>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                                <Pagination :data="students" />
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>