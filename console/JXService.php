<?php
namespace JXconsole\console;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class JXService extends Command
{
    protected function configure()
    {
        $this->setName('JXService')
            ->setDescription('Prints Hello-World!')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('filename', InputArgument::REQUIRED, 'Pass the filename.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Hello World!, %s', $input->getArgument('filename')));
        file_put_contents($input->getArgument('filename'),"Class created sucess");
        return Command::SUCCESS;
    }
}