import { notify } from "@kyvg/vue3-notification";

// This function will be used to handle errors in the try catch Axios requests.
export function handleErrors(error) {
    const errorMessage = error.response.data.errors;

    if (isObject(errorMessage)) {
        // If error is an object (contains multiple errors)
        for (const [key, value] of Object.entries(errorMessage)) {
            notify({
                title: "Error",
                text: value,
                type: "error",
            });
        }
    } else {
        // If error is a string (contains a single error)
        notify({
            title: "Error",
            text: errorMessage,
            type: "error",
        });
    }
}

export function isObject(value) {
    return (
        typeof value === "object" &&
        value !== null &&
        !Array.isArray(value)
    );
}
