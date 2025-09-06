export const setErrorsToFields = (errors, setFieldError) => {
    if (errors) {
        Object.entries(errors).forEach(([key, value]) => {
            setFieldError(key, value);
        });
    }
};
