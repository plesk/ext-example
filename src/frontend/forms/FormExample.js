import { createElement, ServerForm, FormFieldText } from '@plesk/plesk-ext-sdk';

export default function FormExample() {
    return (
        <ServerForm action="/api/save" successUrl="/overview" successMessage="Form was saved successfully." cancelUrl="/overview">
            <FormFieldText name="exampleText" label="Example Text" required />
        </ServerForm>
    );
}
