<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPc48Wkk\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPc48Wkk/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPc48Wkk.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPc48Wkk\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerPc48Wkk\App_KernelDevDebugContainer([
    'container.build_hash' => 'Pc48Wkk',
    'container.build_id' => '6fb5ed9d',
    'container.build_time' => 1592054291,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPc48Wkk');