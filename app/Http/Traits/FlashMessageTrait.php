<?php

namespace App\Http\Traits;

trait FlashMessageTrait
{
    /**
     * Flash a success message
     *
     * @param string $message
     * @return void
     */
    protected function flashSuccess($message)
    {
        session()->flash('success', $message);
    }

    /**
     * Flash an error message
     *
     * @param string $message
     * @return void
     */
    protected function flashError($message)
    {
        session()->flash('error', $message);
    }

    /**
     * Flash a warning message
     *
     * @param string $message
     * @return void
     */
    protected function flashWarning($message)
    {
        session()->flash('warning', $message);
    }

    /**
     * Flash an info message
     *
     * @param string $message
     * @return void
     */
    protected function flashInfo($message)
    {
        session()->flash('info', $message);
    }

    /**
     * Flash success and redirect
     *
     * @param string $route
     * @param string $message
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectWithSuccess($route, $message, $parameters = [])
    {
        $this->flashSuccess($message);
        return redirect()->route($route, $parameters);
    }

    /**
     * Flash error and redirect
     *
     * @param string $route
     * @param string $message
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectWithError($route, $message, $parameters = [])
    {
        $this->flashError($message);
        return redirect()->route($route, $parameters);
    }

    /**
     * Redirect back with error
     *
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBackWithError($message)
    {
        $this->flashError($message);
        return redirect()->back()->withInput();
    }
}