import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import { Textarea } from "@headlessui/react";
import { useForm, usePage } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export function MaterialsSection() {
    const { flash } = usePage().props;

    const { data, setData, post, processing, errors, reset } = useForm({
        title: "",
        file: null,
        description: "",
    });

    const submitForm = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append("title", data.title);
        formData.append("description", data.description);
        formData.append("file", data.file);

        post("/create-material", {
            data: formData,
            headers: {
                "Content-Type": "multipart/form-data",
            },
            onFinish: () => reset("title", "description", "file"),
        });
    };
    return (
        <>
           <section id="materials-section" className="tab-content active">
                <section className="admin-section">
                    <h2>Post Study Materials</h2>
                    <form onSubmit={submitForm}>
                        <InputLabel htmlFor="title">Title</InputLabel>
                        <TextInput
                            type="text"
                            id="material-title"
                            name="title"
                            value={data.title}
                            onChange={(e) => setData("title", e.target.value)}
                            required
                        />
                         <InputLabel htmlFor="material-description">
                            Description
                        </InputLabel>
                        <Textarea
                            id="material-description"
                            name="description"
                            rows="4"
                            value={data.description}
                            onChange={(e) =>
                                setData("description", e.target.value)
                            }
                            required
                        ></Textarea>

                        <InputLabel htmlFor="file">Upload File</InputLabel>
                        <input
                            type="file"
                            id="material-file"
                            name="file"
                            onChange={(e) => setData("file", e.target.files[0])}
                            required
                        />

                        <PrimaryButton disabled={processing}>
                            Post Study Material
                        </PrimaryButton>
                    </form>
                </section>
            </section>
        </>
    );
}